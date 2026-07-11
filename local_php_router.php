<?php
$root = __DIR__ . '/public_html';
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = rtrim($path, '/');

foreach (glob($root . '/diller/*.php') as $languageFile) {
    $source = file_get_contents($languageFile);
    if (preg_match_all('/\$lang\[([A-Za-z0-9_]+)\]/', $source, $matches)) {
        foreach ($matches[1] as $constant) {
            if (!defined($constant)) {
                define($constant, $constant);
            }
        }
    }
}

if ($path === '') {
    $path = '/';
}

if ($path === '/504.php' || str_starts_with($path, '/admin') || str_starts_with($path, '/Eski')) {
    http_response_code(404);
    echo 'Not found';
    return true;
}

$file = realpath($root . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if ($file && str_starts_with($file, realpath($root)) && is_file($file)) {
    return false;
}

$routes = [
    '/' => ['index.php', []],
    '/kurumsal' => ['kurumsal.php', []],
    '/tasarim' => ['tasarim.php', []],
    '/urunler' => ['urunler.php', ['link' => '']],
    '/iletisim' => ['iletisim.php', []],
];

if (isset($routes[$path])) {
    [$script, $query] = $routes[$path];
    $_GET = array_merge($_GET, $query);
    chdir($root);
    require $root . '/' . $script;
    return true;
}

if (preg_match('#^/koleksiyon/([^/]+)$#', $path, $match)) {
    $_GET['link'] = $match[1];
    chdir($root);
    require $root . '/koleksiyon.php';
    return true;
}

if (preg_match('#^/galeri/([^/]+)$#', $path, $match)) {
    $_GET['link'] = $match[1];
    chdir($root);
    require $root . '/galeri.php';
    return true;
}

if (preg_match('#^/kategori/([^/]+)$#', $path, $match)) {
    $_GET['link'] = $match[1];
    chdir($root);
    require $root . '/urun-kategori.php';
    return true;
}

http_response_code(404);
echo 'Not found';
return true;
