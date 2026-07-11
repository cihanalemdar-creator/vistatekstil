<?php
declare(strict_types=1);

define('VISTA_PROJECT_ROOT', dirname(__DIR__, 2));
define('VISTA_REDESIGN_ROOT', dirname(__DIR__));

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function h(mixed $value): string
{
    return e($value);
}

function normalize_path(string $path): string
{
    $decoded = rawurldecode($path);
    if ($decoded === '' || $decoded === '/') {
        return '/';
    }

    return '/' . trim(preg_replace('#/+#', '/', $decoded) ?? $decoded, '/');
}

function route_context(array $routeConfig, string $path): array
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

function route_for(array $routeConfig, string $pageKey, string $locale): string
{
    return $routeConfig['pages'][$pageKey]['locales'][$locale]['path']
        ?? $routeConfig['pages']['home']['locales'][$locale]['path']
        ?? '/';
}

function navigation_items(array $routeConfig, string $locale): array
{
    $items = [];
    foreach ($routeConfig['navigationOrder'] as $pageKey) {
        $localized = $routeConfig['pages'][$pageKey]['locales'][$locale] ?? null;
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

function asset_source(array|string $asset): string
{
    return is_array($asset) ? (string) ($asset['src'] ?? '') : $asset;
}

function asset_url(array|string $asset, bool $versioned = false): string
{
    $source = ltrim(asset_source($asset), '/');
    $url = '/' . $source;
    if (!$versioned || $source === '' || !str_starts_with($source, 'redesign/')) {
        return $url;
    }

    $file = VISTA_PROJECT_ROOT . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $source);
    if (!is_file($file)) {
        return $url;
    }

    return $url . '?v=' . substr(hash('sha256', (string) filemtime($file) . ':' . (string) filesize($file)), 0, 10);
}

function asset_alt(array $asset, string $locale): string
{
    return (string) ($asset['alt'][$locale] ?? $asset['alt']['en'] ?? '');
}

function safe_href(string $value): string
{
    $value = trim($value);
    if ($value === '' || preg_match('~^(?:/|\#|mailto:|tel:|https://)~i', $value) !== 1) {
        return '#';
    }

    return $value;
}

function query_url(string $path, array $params = [], ?string $fragment = null): string
{
    $query = http_build_query(array_filter($params, static fn(mixed $value): bool => $value !== null && $value !== ''), '', '&', PHP_QUERY_RFC3986);
    $url = $path . ($query !== '' ? '?' . $query : '');
    if ($fragment !== null && $fragment !== '') {
        $url .= '#' . rawurlencode($fragment);
    }

    return $url;
}

function render_component(string $componentName, array $props = []): void
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

function render_view(string $viewName, array $context = []): void
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

function section_navigation_items(array $routePage, ?array $interior): array
{
    $config = $routePage['sectionNavigation'] ?? false;
    if ($config === false || $interior === null) {
        return [];
    }

    $items = [];
    $idField = (string) ($config['idField'] ?? 'id');
    foreach ($interior['sections'] ?? [] as $index => $section) {
        $id = (string) ($section[$idField] ?? $section['id'] ?? $section['asset'] ?? 'section-' . ($index + 1));
        $items[] = ['id' => $id, 'label' => (string) $section['title']];
    }

    return $items;
}

function breadcrumb_items(array $routeConfig, string $pageKey, string $locale): array
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

function gallery_state(array $items, array $filters, int $perPage = 24): array
{
    $requestedCategory = isset($_GET['category']) && is_string($_GET['category']) ? $_GET['category'] : 'all';
    $category = array_key_exists($requestedCategory, $filters) ? $requestedCategory : 'all';
    $filtered = $category === 'all'
        ? array_values($items)
        : array_values(array_filter($items, static fn(array $item): bool => ($item['category'] ?? '') === $category));

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
