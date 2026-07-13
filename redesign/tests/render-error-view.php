<?php

$_SERVER['REQUEST_URI'] = '/test-server-error';
require dirname(__DIR__) . '/app/helpers.php';

$context = require dirname(__DIR__) . '/app/error-context.php';
extract($context, EXTR_SKIP);
ob_start();
require dirname(__DIR__) . '/layouts/site.php';
$html = (string) ob_get_clean();

$checks = [
    strpos($html, 'site-header') !== false,
    strpos($html, 'site-footer') !== false,
    strpos($html, '<h1') !== false,
    !preg_match('/stack trace|uncaught|\.php:\d+/i', $html),
];

if (in_array(false, $checks, true)) {
    fwrite(STDERR, "500 error view smoke test failed.\n");
    exit(1);
}

echo "500 error view: PASS\n";
