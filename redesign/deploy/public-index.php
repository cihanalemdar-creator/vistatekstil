<?php

// Keep the established site available during the short PHP 5.6 -> 8.1 cutover.
if (version_compare(PHP_VERSION, '8.1.0', '<')) {
    $legacyPath = parse_url(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/', PHP_URL_PATH);
    $legacyRoutes = array(
        '/' => 'index-legacy.php',
        '/kurumsal' => 'kurumsal.php',
        '/urunler' => 'urunler.php',
        '/tasarim' => 'tasarim.php',
        '/iletisim' => 'iletisim.php',
    );

    if ($legacyPath === '/koleksiyon/referans') {
        $_GET['link'] = 'referans';
        require __DIR__ . '/koleksiyon.php';
        exit;
    }
    if ($legacyPath === '/galeri/galerim2') {
        $_GET['link'] = 'galerim2';
        require __DIR__ . '/galeri.php';
        exit;
    }

    $legacyFile = isset($legacyRoutes[$legacyPath]) ? $legacyRoutes[$legacyPath] : 'index-legacy.php';
    require __DIR__ . '/' . $legacyFile;
    exit;
}

define('VISTA_ENVIRONMENT', 'production');

ini_set('display_errors', '0');
ini_set('log_errors', '1');

require __DIR__ . '/redesign/index.php';
