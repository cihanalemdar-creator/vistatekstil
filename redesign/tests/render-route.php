<?php

$_SERVER['REQUEST_URI'] = isset($argv[1]) ? $argv[1] : '/';
require dirname(__DIR__) . '/index.php';
