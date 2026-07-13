<?php
declare(strict_types=1);

require dirname(__DIR__) . '/app/helpers.php';
require dirname(__DIR__) . '/app/contact.php';

$contract = require dirname(__DIR__) . '/data/form.php';
$failures = [];

foreach (['country', 'fabricType', 'subject'] as $optionalField) {
    if (($contract['fields'][$optionalField]['required'] ?? true) !== false) {
        $failures[] = $optionalField . ' must remain optional';
    }
}

$_POST = [
    'name' => 'Test User',
    'company' => 'Test Brand',
    'email' => 'buyer@example.com',
    'category' => 'womenswear',
    'quantity' => '250',
    'message' => 'A production enquiry with enough detail.',
    'privacy' => '1',
];
[$validValues, $validErrors] = contact_validate_submission($contract, 'en');
if ($validErrors !== []) {
    $failures[] = 'valid basic submission rejected: ' . json_encode($validErrors);
}

$_POST['email'] = 'not-an-email';
$_POST['category'] = 'invalid-category';
$_POST['quantity'] = '0';
unset($_POST['privacy']);
[, $invalidErrors] = contact_validate_submission($contract, 'en');
foreach (['email', 'category', 'quantity', 'privacy'] as $expectedError) {
    if (!isset($invalidErrors[$expectedError])) {
        $failures[] = 'missing validation error: ' . $expectedError;
    }
}

$validValues['message'] = '<script>alert(1)</script>';
$body = contact_email_body($contract, 'en', $validValues);
if (str_contains($body, '<script>') || !str_contains($body, '&lt;script&gt;')) {
    $failures[] = 'email body escaping failed';
}

$configuration = contact_configuration();
if ($configuration['enabled']) {
    $failures[] = 'contact transport must stay disabled without a private production config';
}

if ($failures !== []) {
    fwrite(STDERR, implode(PHP_EOL, $failures) . PHP_EOL);
    exit(1);
}

echo "Contact form validation: PASS\n";
