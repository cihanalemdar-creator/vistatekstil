<?php
declare(strict_types=1);

$documentRoot = realpath((string) ($_SERVER['DOCUMENT_ROOT'] ?? ''));
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$file = $documentRoot !== false ? realpath($documentRoot . $path) : false;

// Local production fixtures use junctions to the read-only legacy asset tree.
if ($file !== false && is_file($file)) {
    return false;
}

require (string) $documentRoot . '/index.php';
