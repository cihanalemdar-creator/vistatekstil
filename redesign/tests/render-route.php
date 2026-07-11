<?php
declare(strict_types=1);

$_SERVER['REQUEST_URI'] = $argv[1] ?? '/';
require dirname(__DIR__) . '/index.php';
