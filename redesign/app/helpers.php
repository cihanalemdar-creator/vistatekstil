<?php

define('VISTA_PROJECT_ROOT', dirname(dirname(__DIR__)));
define('VISTA_REDESIGN_ROOT', dirname(__DIR__));

if ((string) ini_get('date.timezone') === '') {
    date_default_timezone_set('Europe/Istanbul');
}

if (!function_exists('str_starts_with')) {
    function str_starts_with($haystack, $needle)
    {
        return $needle === '' || strpos($haystack, $needle) === 0;
    }
}

function vista_random_bytes($length)
{
    if (function_exists('random_bytes')) {
        return random_bytes($length);
    }

    if (function_exists('openssl_random_pseudo_bytes')) {
        $strong = false;
        $bytes = openssl_random_pseudo_bytes($length, $strong);
        if (is_string($bytes) && strlen($bytes) === $length && $strong) {
            return $bytes;
        }
    }

    throw new RuntimeException('A secure random source is not available.');
}

function app_environment()
{
    $environment = defined('VISTA_ENVIRONMENT')
        ? (string) VISTA_ENVIRONMENT
        : (string) (getenv('VISTA_ENVIRONMENT') ?: 'development');

    return in_array($environment, ['development', 'production'], true) ? $environment : 'development';
}

function is_production()
{
    return app_environment() === 'production';
}

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function h($value)
{
    return e($value);
}

function localized_text($locale, array $translations)
{
    if (isset($translations[$locale])) {
        return (string) $translations[$locale];
    }
    if (isset($translations['en'])) {
        return (string) $translations['en'];
    }

    $fallback = reset($translations);
    return $fallback === false ? '' : (string) $fallback;
}

function normalize_path($path)
{
    $decoded = rawurldecode($path);
    if ($decoded === '' || $decoded === '/') {
        return '/';
    }

    $normalized = preg_replace('#/+#', '/', $decoded);
    return '/' . trim($normalized === null ? $decoded : $normalized, '/');
}

function route_context(array $routeConfig, $path)
{
    $normalized = normalize_path($path);
    foreach ($routeConfig['pages'] as $pageKey => $page) {
        foreach ($page['locales'] as $locale => $localized) {
            if ($normalized === normalize_path($localized['path'])) {
                return [
                    'pageKey' => $pageKey,
                    'locale' => $locale,
                    'found' => true,
                    'page' => $page,
                    'localized' => $localized,
                ];
            }
        }
    }

    return [
        'pageKey' => 'home',
        'locale' => 'tr',
        'found' => false,
        'page' => $routeConfig['pages']['home'],
        'localized' => $routeConfig['pages']['home']['locales']['tr'],
    ];
}

function route_for(array $routeConfig, $pageKey, $locale)
{
    if (isset($routeConfig['pages'][$pageKey]['locales'][$locale]['path'])) {
        return $routeConfig['pages'][$pageKey]['locales'][$locale]['path'];
    }
    if (isset($routeConfig['pages']['home']['locales'][$locale]['path'])) {
        return $routeConfig['pages']['home']['locales'][$locale]['path'];
    }

    return '/';
}

function navigation_items(array $routeConfig, $locale)
{
    $items = [];
    foreach ($routeConfig['navigationOrder'] as $pageKey) {
        $localized = isset($routeConfig['pages'][$pageKey]['locales'][$locale]) ? $routeConfig['pages'][$pageKey]['locales'][$locale] : null;
        if ($localized === null) {
            continue;
        }
        $items[] = [
            'key' => $pageKey,
            'path' => $localized['path'],
            'label' => $localized['navigationLabel'],
            'activeKey' => $routeConfig['pages'][$pageKey]['activeNavigationKey'],
        ];
    }

    return $items;
}

function asset_source($asset)
{
    return is_array($asset) ? (isset($asset['src']) ? (string) $asset['src'] : '') : $asset;
}

function asset_url($asset, $versioned = false)
{
    $source = ltrim(asset_source($asset), '/');
    $publicSource = is_production() && str_starts_with($source, 'public_html/')
        ? substr($source, strlen('public_html/'))
        : $source;
    $url = '/' . $publicSource;
    if (!$versioned || $source === '' || !str_starts_with($source, 'redesign/')) {
        return $url;
    }

    $file = VISTA_PROJECT_ROOT . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $source);
    if (!is_file($file)) {
        return $url;
    }

    return $url . '?v=' . substr(hash('sha256', (string) filemtime($file) . ':' . (string) filesize($file)), 0, 10);
}

function asset_alt(array $asset, $locale)
{
    if (isset($asset['alt'][$locale])) {
        return (string) $asset['alt'][$locale];
    }

    return isset($asset['alt']['en']) ? (string) $asset['alt']['en'] : '';
}

function safe_href($value)
{
    $value = trim($value);
    if ($value === '' || preg_match('~^(?:/|\#|mailto:|tel:|https://)~i', $value) !== 1) {
        return '#';
    }

    return $value;
}

function query_url($path, array $params = array(), $fragment = null)
{
    $query = http_build_query(array_filter($params, static function ($value) {
        return $value !== null && $value !== '';
    }), '', '&', PHP_QUERY_RFC3986);
    $url = $path . ($query !== '' ? '?' . $query : '');
    if ($fragment !== null && $fragment !== '') {
        $url .= '#' . rawurlencode($fragment);
    }

    return $url;
}

function render_component($componentName, array $props = array())
{
    if (preg_match('/^[a-z0-9-]+$/', $componentName) !== 1) {
        throw new InvalidArgumentException('Invalid component name.');
    }
    $file = VISTA_REDESIGN_ROOT . '/components/' . $componentName . '.php';
    if (!is_file($file)) {
        throw new RuntimeException('Component not found: ' . $componentName);
    }
    extract($props, EXTR_SKIP);
    require $file;
}

function render_view($viewName, array $context = array())
{
    if (preg_match('#^[a-z0-9/_-]+$#', $viewName) !== 1) {
        throw new InvalidArgumentException('Invalid view name.');
    }
    $file = VISTA_REDESIGN_ROOT . '/views/' . $viewName . '.php';
    if (!is_file($file)) {
        throw new RuntimeException('View not found: ' . $viewName);
    }
    extract($context, EXTR_SKIP);
    require $file;
}

function section_navigation_items(array $routePage, $interior)
{
    $config = isset($routePage['sectionNavigation']) ? $routePage['sectionNavigation'] : false;
    if ($config === false || $interior === null) {
        return [];
    }

    $items = [];
    $idField = isset($config['idField']) ? (string) $config['idField'] : 'id';
    $sections = isset($interior['sections']) ? $interior['sections'] : array();
    foreach ($sections as $index => $section) {
        if (isset($section[$idField])) {
            $id = (string) $section[$idField];
        } elseif (isset($section['id'])) {
            $id = (string) $section['id'];
        } elseif (isset($section['asset'])) {
            $id = (string) $section['asset'];
        } else {
            $id = 'section-' . ($index + 1);
        }
        $items[] = ['id' => $id, 'label' => (string) $section['title']];
    }

    return $items;
}

function breadcrumb_items(array $routeConfig, $pageKey, $locale)
{
    if ($pageKey === 'home') {
        return [];
    }

    return [
        [
            'label' => $routeConfig['pages']['home']['locales'][$locale]['navigationLabel'],
            'href' => route_for($routeConfig, 'home', $locale),
        ],
        [
            'label' => $routeConfig['pages'][$pageKey]['locales'][$locale]['navigationLabel'],
            'href' => null,
        ],
    ];
}

function gallery_state(array $items, array $filters, $perPage = 24)
{
    $requestedCategory = isset($_GET['category']) && is_string($_GET['category']) ? $_GET['category'] : 'all';
    $category = array_key_exists($requestedCategory, $filters) ? $requestedCategory : 'all';
    $filtered = $category === 'all'
        ? array_values($items)
        : array_values(array_filter($items, static function (array $item) use ($category) {
            return (isset($item['category']) ? $item['category'] : '') === $category;
        }));

    $requestedPage = isset($_GET['page']) && is_scalar($_GET['page']) ? filter_var((string) $_GET['page'], FILTER_VALIDATE_INT) : false;
    $page = $requestedPage !== false && $requestedPage > 0 ? (int) $requestedPage : 1;
    $pageCount = max(1, (int) ceil(count($filtered) / $perPage));
    $page = min($page, $pageCount);

    return [
        'category' => $category,
        'page' => $page,
        'pageCount' => $pageCount,
        'total' => count($filtered),
        'items' => array_slice($filtered, ($page - 1) * $perPage, $perPage),
        'perPage' => $perPage,
    ];
}

function product_catalog_state(array $categories, $perPage = 24)
{
    $requestedCategory = isset($_GET['category']) && is_string($_GET['category']) ? $_GET['category'] : null;
    $catalogCategories = array_intersect_key($categories, array_flip(['womenswear', 'menswear', 'kidswear']));
    if ($requestedCategory === null || !array_key_exists($requestedCategory, $catalogCategories)) {
        return null;
    }

    $items = array_values($catalogCategories[$requestedCategory]);
    $requestedPage = isset($_GET['page']) && is_scalar($_GET['page']) ? filter_var((string) $_GET['page'], FILTER_VALIDATE_INT) : false;
    $page = $requestedPage !== false && $requestedPage > 0 ? (int) $requestedPage : 1;
    $pageCount = max(1, (int) ceil(count($items) / $perPage));
    $page = min($page, $pageCount);

    return [
        'category' => $requestedCategory,
        'page' => $page,
        'pageCount' => $pageCount,
        'total' => count($items),
        'items' => array_slice($items, ($page - 1) * $perPage, $perPage),
        'perPage' => $perPage,
    ];
}
