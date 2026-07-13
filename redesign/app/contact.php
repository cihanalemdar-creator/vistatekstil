<?php
declare(strict_types=1);

function contact_configuration(): array
{
    $path = (string) (getenv('VISTA_CONTACT_CONFIG') ?: dirname(VISTA_PROJECT_ROOT, 3) . DIRECTORY_SEPARATOR . '.vista-contact.php');
    $config = is_production() && is_file($path) ? require $path : [];
    $required = ['tenantId', 'clientId', 'clientSecret', 'sender', 'recipient'];
    $complete = is_array($config) && ($config['enabled'] ?? false) === true && ($config['transport'] ?? '') === 'microsoft_graph';

    foreach ($required as $key) {
        if (!isset($config[$key]) || !is_string($config[$key]) || trim($config[$key]) === '') {
            $complete = false;
        }
    }
    if ($complete) {
        $complete = function_exists('curl_init')
            && class_exists('finfo')
            && function_exists('mb_strlen')
            && preg_match('/^[0-9a-f-]{36}$/i', (string) $config['tenantId']) === 1
            && preg_match('/^[0-9a-f-]{36}$/i', (string) $config['clientId']) === 1
            && filter_var($config['sender'], FILTER_VALIDATE_EMAIL) !== false
            && filter_var($config['recipient'], FILTER_VALIDATE_EMAIL) !== false;
    }

    return ['enabled' => $complete, 'path' => $path, 'settings' => is_array($config) ? $config : []];
}

function contact_form_state(array $contract, string $locale, string $actionPath): array
{
    $configuration = contact_configuration();
    $state = [
        'enabled' => $configuration['enabled'],
        'csrf' => '',
        'status' => null,
        'message' => null,
        'errors' => [],
        'values' => [],
        'privacy' => false,
    ];

    if (!$configuration['enabled']) {
        return $state;
    }

    contact_start_session();
    $state['csrf'] = contact_csrf_token();

    if (isset($_SESSION['vista_contact_flash']) && is_array($_SESSION['vista_contact_flash'])) {
        $state['status'] = (string) ($_SESSION['vista_contact_flash']['status'] ?? 'success');
        $state['message'] = (string) ($_SESSION['vista_contact_flash']['message'] ?? '');
        unset($_SESSION['vista_contact_flash']);
    }

    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
        return $state;
    }

    if (!isset($_POST['_csrf']) || !is_string($_POST['_csrf']) || !hash_equals($state['csrf'], $_POST['_csrf'])) {
        http_response_code(400);
        $state['status'] = 'error';
        $state['message'] = contact_message($locale, 'session');
        return $state;
    }

    if (isset($_POST['website']) && is_string($_POST['website']) && trim($_POST['website']) !== '') {
        http_response_code(400);
        $state['status'] = 'error';
        $state['message'] = contact_message($locale, 'invalid');
        return $state;
    }

    [$values, $errors] = contact_validate_submission($contract, $locale);
    $state['values'] = $values;
    $state['errors'] = $errors;
    $state['privacy'] = isset($_POST['privacy']) && $_POST['privacy'] === '1';
    if ($errors !== []) {
        http_response_code(422);
        $state['status'] = 'error';
        $state['message'] = contact_message($locale, 'validation');
        return $state;
    }

    $attachment = contact_validate_attachment($locale);
    if (isset($attachment['error'])) {
        http_response_code(422);
        $state['status'] = 'error';
        $state['message'] = $attachment['error'];
        $state['errors']['file'] = $attachment['error'];
        return $state;
    }

    if (!contact_reserve_rate_limit()) {
        http_response_code(429);
        header('Retry-After: 3600');
        $state['status'] = 'error';
        $state['message'] = contact_message($locale, 'rate');
        return $state;
    }

    $delivered = contact_send_graph_mail($configuration['settings'], $contract, $locale, $values, $attachment['file'] ?? null);
    if (!$delivered) {
        http_response_code(503);
        $state['status'] = 'error';
        $state['message'] = contact_message($locale, 'delivery');
        return $state;
    }

    $_SESSION['vista_contact_csrf'] = bin2hex(random_bytes(32));
    $_SESSION['vista_contact_flash'] = ['status' => 'success', 'message' => contact_message($locale, 'success')];
    header('Location: ' . $actionPath . '#quote-form', true, 303);
    exit;
}

function contact_start_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    session_name('vista_contact');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => is_production(),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

function contact_csrf_token(): string
{
    if (!isset($_SESSION['vista_contact_csrf']) || !is_string($_SESSION['vista_contact_csrf'])) {
        $_SESSION['vista_contact_csrf'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['vista_contact_csrf'];
}

function contact_validate_submission(array $contract, string $locale): array
{
    $values = [];
    $errors = [];
    foreach ($contract['fields'] as $name => $field) {
        if ($name === 'file') {
            continue;
        }
        $raw = $_POST[$name] ?? '';
        $value = is_string($raw) ? trim($raw) : '';
        $values[$name] = $value;

        if (($field['required'] ?? false) && $value === '') {
            $errors[$name] = contact_message($locale, 'required');
            continue;
        }
        if ($value === '') {
            continue;
        }
        if (!mb_check_encoding($value, 'UTF-8')) {
            $errors[$name] = contact_message($locale, 'invalid');
            continue;
        }
        if (mb_strlen($value) > contact_field_max_length($name)) {
            $errors[$name] = contact_message($locale, 'tooLong');
            continue;
        }
        if ($name === 'email' && filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            $errors[$name] = contact_message($locale, 'email');
            continue;
        }
        if (isset($field['options']) && !array_key_exists($value, $field['options'])) {
            $errors[$name] = contact_message($locale, 'option');
            continue;
        }
        if ($field['type'] === 'number') {
            $number = filter_var($value, FILTER_VALIDATE_INT);
            $minimum = (int) ($field['min'] ?? 1);
            if ($number === false || $number < $minimum || $number > 1000000) {
                $errors[$name] = contact_message($locale, 'number');
            }
        }
    }

    if (!isset($_POST['privacy']) || $_POST['privacy'] !== '1') {
        $errors['privacy'] = contact_message($locale, 'privacy');
    }

    return [$values, $errors];
}

function contact_field_max_length(string $name): int
{
    return match ($name) {
        'message' => 5000,
        'delivery', 'subject' => 200,
        'email' => 254,
        default => 120,
    };
}

function contact_validate_attachment(string $locale): array
{
    if (!isset($_FILES['file']) || !is_array($_FILES['file']) || ($_FILES['file']['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return ['file' => null];
    }

    $upload = $_FILES['file'];
    if (($upload['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || !isset($upload['tmp_name'], $upload['name'], $upload['size'])) {
        return ['error' => contact_message($locale, 'file')];
    }
    if ((int) $upload['size'] <= 0 || (int) $upload['size'] > 2 * 1024 * 1024 || !is_uploaded_file((string) $upload['tmp_name'])) {
        return ['error' => contact_message($locale, 'fileSize')];
    }

    $extension = strtolower(pathinfo((string) $upload['name'], PATHINFO_EXTENSION));
    $allowed = [
        'pdf' => ['application/pdf'],
        'doc' => ['application/msword', 'application/octet-stream'],
        'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/octet-stream'],
        'xls' => ['application/vnd.ms-excel', 'application/octet-stream'],
        'xlsx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip', 'application/octet-stream'],
        'jpg' => ['image/jpeg'],
        'jpeg' => ['image/jpeg'],
        'png' => ['image/png'],
        'zip' => ['application/zip', 'application/x-zip-compressed', 'application/octet-stream'],
    ];
    $mime = (new finfo(FILEINFO_MIME_TYPE))->file((string) $upload['tmp_name']) ?: 'application/octet-stream';
    if (!isset($allowed[$extension]) || !in_array($mime, $allowed[$extension], true)) {
        return ['error' => contact_message($locale, 'fileType')];
    }

    $contents = file_get_contents((string) $upload['tmp_name']);
    if (!is_string($contents)) {
        return ['error' => contact_message($locale, 'file')];
    }
    $name = preg_replace('/[^\pL\pN._ -]+/u', '_', basename((string) $upload['name'])) ?: 'attachment.' . $extension;
    return ['file' => [
        'name' => mb_substr($name, 0, 120),
        'mime' => $mime,
        'contents' => $contents,
    ]];
}

function contact_reserve_rate_limit(): bool
{
    $identity = (string) ($_SERVER['REMOTE_ADDR'] ?? 'unknown');
    $file = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'vista-contact-' . hash('sha256', $identity) . '.json';
    $handle = fopen($file, 'c+');
    if ($handle === false || !flock($handle, LOCK_EX)) {
        if (is_resource($handle)) {
            fclose($handle);
        }
        return false;
    }

    $raw = stream_get_contents($handle);
    $timestamps = is_string($raw) ? json_decode($raw, true) : [];
    $timestamps = is_array($timestamps) ? array_values(array_filter($timestamps, static fn($value): bool => is_int($value) && $value > time() - 3600)) : [];
    if (count($timestamps) >= 5) {
        flock($handle, LOCK_UN);
        fclose($handle);
        return false;
    }

    $timestamps[] = time();
    rewind($handle);
    ftruncate($handle, 0);
    fwrite($handle, json_encode($timestamps, JSON_THROW_ON_ERROR));
    fflush($handle);
    flock($handle, LOCK_UN);
    fclose($handle);
    return true;
}

function contact_send_graph_mail(array $settings, array $contract, string $locale, array $values, ?array $attachment): bool
{
    $tokenResponse = contact_http_post(
        'https://login.microsoftonline.com/' . rawurlencode((string) $settings['tenantId']) . '/oauth2/v2.0/token',
        ['Content-Type: application/x-www-form-urlencoded'],
        http_build_query([
            'client_id' => $settings['clientId'],
            'client_secret' => $settings['clientSecret'],
            'scope' => 'https://graph.microsoft.com/.default',
            'grant_type' => 'client_credentials',
        ], '', '&', PHP_QUERY_RFC3986)
    );
    $tokenPayload = json_decode($tokenResponse['body'], true);
    if ($tokenResponse['status'] !== 200 || !is_array($tokenPayload) || !isset($tokenPayload['access_token'])) {
        error_log('[Vista contact] Microsoft Graph token request failed with HTTP ' . $tokenResponse['status']);
        return false;
    }

    $subjectCompany = preg_replace('/[\r\n]+/', ' ', $values['company'] ?: $values['name']) ?: 'Web enquiry';
    $subjectDetail = preg_replace('/[\r\n]+/', ' ', $values['subject'] ?: $values['category']) ?: 'Production';
    $message = [
        'subject' => '[Vista Web] ' . $subjectCompany . ' - ' . $subjectDetail,
        'body' => ['contentType' => 'HTML', 'content' => contact_email_body($contract, $locale, $values)],
        'toRecipients' => [['emailAddress' => ['address' => (string) $settings['recipient']]]],
        'replyTo' => [['emailAddress' => ['address' => $values['email'], 'name' => $values['name']]]],
    ];
    if ($attachment !== null && is_string($attachment['contents'])) {
        $message['attachments'] = [[
            '@odata.type' => '#microsoft.graph.fileAttachment',
            'name' => $attachment['name'],
            'contentType' => $attachment['mime'],
            'contentBytes' => base64_encode($attachment['contents']),
        ]];
    }

    $mailResponse = contact_http_post(
        'https://graph.microsoft.com/v1.0/users/' . rawurlencode((string) $settings['sender']) . '/sendMail',
        ['Authorization: Bearer ' . $tokenPayload['access_token'], 'Content-Type: application/json'],
        json_encode(['message' => $message, 'saveToSentItems' => true], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE)
    );
    if ($mailResponse['status'] !== 202) {
        error_log('[Vista contact] Microsoft Graph sendMail failed with HTTP ' . $mailResponse['status']);
        return false;
    }

    return true;
}

function contact_http_post(string $url, array $headers, string $body): array
{
    $curl = curl_init($url);
    if ($curl === false) {
        return ['status' => 0, 'body' => ''];
    }
    curl_setopt_array($curl, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $body,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 8,
        CURLOPT_TIMEOUT => 25,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
        CURLOPT_USERAGENT => 'VistaTekstilContact/1.0',
    ]);
    $responseBody = curl_exec($curl);
    $status = (int) curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
    curl_close($curl);

    return ['status' => $status, 'body' => is_string($responseBody) ? $responseBody : ''];
}

function contact_email_body(array $contract, string $locale, array $values): string
{
    $labels = $contract['labels'][$locale] ?? $contract['labels']['en'];
    $rows = '';
    foreach ($values as $name => $value) {
        if ($value === '') {
            continue;
        }
        $label = $labels[$name] ?? $name;
        if (isset($contract['fields'][$name]['options'][$value])) {
            $option = $contract['fields'][$name]['options'][$value];
            $value = isset($option['labelKey']) ? ($labels[$option['labelKey']] ?? $value) : ($option[$locale] ?? $option['en'] ?? $value);
        }
        $rows .= '<tr><th style="padding:8px;text-align:left;vertical-align:top">' . e($label) . '</th><td style="padding:8px">' . nl2br(e($value)) . '</td></tr>';
    }

    return '<h1>Vista Tekstil web formu</h1><table style="border-collapse:collapse">' . $rows . '</table>';
}

function contact_message(string $locale, string $key): string
{
    $messages = [
        'required' => ['tr' => 'Bu alan zorunludur.', 'en' => 'This field is required.', 'de' => 'Dieses Feld ist erforderlich.', 'es' => 'Este campo es obligatorio.'],
        'email' => ['tr' => 'Geçerli bir e-posta adresi girin.', 'en' => 'Enter a valid email address.', 'de' => 'Geben Sie eine gültige E-Mail-Adresse ein.', 'es' => 'Introduzca un correo electrónico válido.'],
        'option' => ['tr' => 'Geçerli bir seçenek belirleyin.', 'en' => 'Choose a valid option.', 'de' => 'Wählen Sie eine gültige Option.', 'es' => 'Seleccione una opción válida.'],
        'number' => ['tr' => 'Geçerli bir sayı girin.', 'en' => 'Enter a valid number.', 'de' => 'Geben Sie eine gültige Zahl ein.', 'es' => 'Introduzca un número válido.'],
        'tooLong' => ['tr' => 'Bu alandaki metin çok uzun.', 'en' => 'The text in this field is too long.', 'de' => 'Der Text in diesem Feld ist zu lang.', 'es' => 'El texto de este campo es demasiado largo.'],
        'privacy' => ['tr' => 'Gizlilik onayı gereklidir.', 'en' => 'Privacy consent is required.', 'de' => 'Die Datenschutzeinwilligung ist erforderlich.', 'es' => 'Se requiere el consentimiento de privacidad.'],
        'file' => ['tr' => 'Dosya yüklenemedi. Lütfen yeniden deneyin.', 'en' => 'The file could not be uploaded. Please try again.', 'de' => 'Die Datei konnte nicht hochgeladen werden. Bitte versuchen Sie es erneut.', 'es' => 'No se pudo adjuntar el archivo. Inténtelo de nuevo.'],
        'fileSize' => ['tr' => 'Dosya en fazla 2 MB olabilir.', 'en' => 'The file must be no larger than 2 MB.', 'de' => 'Die Datei darf höchstens 2 MB groß sein.', 'es' => 'El archivo no puede superar los 2 MB.'],
        'fileType' => ['tr' => 'Bu dosya türü desteklenmiyor.', 'en' => 'This file type is not supported.', 'de' => 'Dieser Dateityp wird nicht unterstützt.', 'es' => 'Este tipo de archivo no es compatible.'],
        'validation' => ['tr' => 'Lütfen işaretlenen alanları kontrol edin.', 'en' => 'Please review the highlighted fields.', 'de' => 'Bitte prüfen Sie die markierten Felder.', 'es' => 'Revise los campos indicados.'],
        'session' => ['tr' => 'Oturum süresi doldu. Sayfayı yenileyip tekrar deneyin.', 'en' => 'Your session expired. Refresh the page and try again.', 'de' => 'Ihre Sitzung ist abgelaufen. Laden Sie die Seite neu und versuchen Sie es erneut.', 'es' => 'La sesión ha caducado. Actualice la página e inténtelo de nuevo.'],
        'invalid' => ['tr' => 'Form isteği geçersiz.', 'en' => 'The form request is invalid.', 'de' => 'Die Formularanfrage ist ungültig.', 'es' => 'La solicitud del formulario no es válida.'],
        'rate' => ['tr' => 'Çok fazla istek gönderildi. Lütfen daha sonra tekrar deneyin.', 'en' => 'Too many requests were sent. Please try again later.', 'de' => 'Es wurden zu viele Anfragen gesendet. Bitte versuchen Sie es später erneut.', 'es' => 'Se han enviado demasiadas solicitudes. Inténtelo más tarde.'],
        'delivery' => ['tr' => 'Mesaj şu anda iletilemedi. Lütfen e-posta veya telefonla bize ulaşın.', 'en' => 'The message could not be delivered right now. Please contact us by email or phone.', 'de' => 'Die Nachricht konnte derzeit nicht zugestellt werden. Bitte kontaktieren Sie uns per E-Mail oder Telefon.', 'es' => 'No se pudo enviar el mensaje. Póngase en contacto por correo o teléfono.'],
        'success' => ['tr' => 'Talebiniz güvenli biçimde iletildi. Ekibimiz sizinle iletişime geçecektir.', 'en' => 'Your enquiry was delivered securely. Our team will contact you.', 'de' => 'Ihre Anfrage wurde sicher übermittelt. Unser Team wird sich mit Ihnen in Verbindung setzen.', 'es' => 'Su solicitud se ha enviado de forma segura. Nuestro equipo se pondrá en contacto con usted.'],
    ];

    return localized_text($locale, $messages[$key] ?? $messages['invalid']);
}
