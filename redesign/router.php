<?php

$requestUri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
$path = parse_url($requestUri, PHP_URL_PATH) ?: '/';
$file = realpath(__DIR__ . '/..' . $path);
$root = realpath(__DIR__ . '/..');

if ($file && $root && strpos($file, $root) === 0 && is_file($file)) {
    return false;
}

require __DIR__ . '/index.php';
