<?php
declare(strict_types=1);

require __DIR__ . '/app/helpers.php';
require __DIR__ . '/app/contact.php';

set_error_handler(static function (int $severity, string $message, string $file, int $line): bool {
    if ((error_reporting() & $severity) === 0) {
        return false;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
});

$bufferLevel = ob_get_level();
ob_start();

try {
    $context = require __DIR__ . '/app/bootstrap.php';
    extract($context, EXTR_SKIP);
    require __DIR__ . '/layouts/site.php';
    ob_end_flush();
} catch (Throwable $exception) {
    while (ob_get_level() > $bufferLevel) {
        ob_end_clean();
    }
    error_log(sprintf(
        '[Vista redesign] %s in %s:%d',
        $exception->getMessage(),
        $exception->getFile(),
        $exception->getLine()
    ));
    if (!headers_sent()) {
        http_response_code(500);
    }
    try {
        $context = require __DIR__ . '/app/error-context.php';
        extract($context, EXTR_SKIP);
        ob_start();
        require __DIR__ . '/layouts/site.php';
        ob_end_flush();
    } catch (Throwable $fallbackException) {
        while (ob_get_level() > $bufferLevel) {
            ob_end_clean();
        }
        error_log('[Vista redesign fallback] ' . $fallbackException->getMessage());
        echo '<!doctype html><html lang="tr"><meta charset="utf-8"><title>Vista Moda Tekstil</title><body><main><h1>Sayfa şu anda görüntülenemiyor.</h1><p><a href="/">Ana sayfa</a></p></main></body></html>';
    }
}
