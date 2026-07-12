<?php
declare(strict_types=1);

$routeConfig = require VISTA_REDESIGN_ROOT . '/config/routes.php';
$locales = require VISTA_REDESIGN_ROOT . '/config/locales.php';
$site = require VISTA_REDESIGN_ROOT . '/data/site.php';
$content = require VISTA_REDESIGN_ROOT . '/data/content.php';
$formContract = require VISTA_REDESIGN_ROOT . '/data/form.php';

$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$path = normalize_path($requestPath);

if ($path === '/robots.txt') {
    header('Content-Type: text/plain; charset=UTF-8');
    echo "User-agent: *\nDisallow: /\n";
    exit;
}

if ($path === '/sitemap.xml') {
    header('Content-Type: application/xml; charset=UTF-8');
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($routeConfig['pages'] as $page) {
        foreach (array_keys($locales) as $sitemapLocale) {
            $localized = $page['locales'][$sitemapLocale];
            if (in_array($localized['publicationStatus'], ['approved', 'published'], true)) {
                echo '  <url><loc>https://www.vistatekstil.com' . e($localized['path']) . '</loc></url>' . "\n";
            }
        }
    }
    echo '</urlset>' . "\n";
    exit;
}

$route = route_context($routeConfig, $path);
if (!$route['found'] && preg_match('#^/(en|de|es)(?:/|$)#', $path, $localeMatch) === 1) {
    $route['locale'] = $localeMatch[1];
}

$locale = $route['locale'];
$pageKey = $route['pageKey'];
$routePage = $route['page'];
$localizedRoute = $route['localized'];
$contentLocale = isset($content['pages']['home'][$locale]) ? $locale : 'en';
$home = $content['pages']['home'][$contentLocale];
$isUnavailableLocale = $route['found'] && ($localizedRoute['publicationStatus'] ?? 'unavailable') === 'unavailable';
$isHome = $route['found'] && $pageKey === 'home' && !$isUnavailableLocale;
$interior = $content['interiors'][$contentLocale][$pageKey] ?? null;
$isNotFound = !$route['found'] || (!$isHome && !$isUnavailableLocale && $interior === null);

if ($isNotFound) {
    http_response_code(404);
}

$publicationStatus = $localizedRoute['publicationStatus'] ?? 'draft';
$isIndexable = !$isNotFound && !$isUnavailableLocale && in_array($publicationStatus, ['approved', 'published'], true);
$unavailableMeta = $locale === 'de'
    ? ['title' => 'Deutsche Inhalte in Vorbereitung | Vista Moda Tekstil', 'description' => 'Die deutsche Version wird derzeit vorbereitet.']
    : ['title' => 'Contenido en español en preparación | Vista Moda Tekstil', 'description' => 'La versión en español se encuentra en preparación.'];
$notFoundMeta = [
    'title' => localized_text($contentLocale, ['tr' => 'Sayfa bulunamadı', 'en' => 'Page not found', 'de' => 'Seite nicht gefunden', 'es' => 'Página no encontrada']) . ' | Vista Moda Tekstil',
    'description' => localized_text($contentLocale, ['tr' => 'Aradığınız sayfa bulunamadı.', 'en' => 'The requested page could not be found.', 'de' => 'Die angeforderte Seite wurde nicht gefunden.', 'es' => 'No se ha encontrado la página solicitada.']),
];
$pageMeta = $isNotFound
    ? $notFoundMeta
    : ($isUnavailableLocale ? $unavailableMeta : ($isHome ? $home['meta'] : $interior['meta']));
$canonicalPath = $isNotFound ? route_for($routeConfig, 'home', $contentLocale) : route_for($routeConfig, $pageKey, $locale);
$canonical = 'https://www.vistatekstil.com' . $canonicalPath;
$heroAsset = $content['assets']['hero_factory'];
$heroVideo = $content['assets']['hero_videos'][$contentLocale];
$pageHeroAssets = [
    'about' => $content['assets']['gallery'][1] ?? $heroAsset,
    'products' => $content['assets']['home_products']['womenswear'],
    'design' => $content['assets']['process']['design'],
    'collection' => $content['assets']['collection'][0],
    'gallery' => $content['assets']['gallery'][0] ?? $heroAsset,
    'contact' => $content['assets']['gallery'][18] ?? $heroAsset,
];

$navigation = navigation_items($routeConfig, $locale);
$activeNavigationKey = $isNotFound ? null : ($routePage['activeNavigationKey'] ?? $pageKey);
$breadcrumbs = $isNotFound || $isHome || $isUnavailableLocale ? [] : breadcrumb_items($routeConfig, $pageKey, $locale);
$sectionNavigation = $isNotFound || $isUnavailableLocale ? [] : section_navigation_items($routePage, $interior);
$gallery = null;
if (!$isNotFound && $pageKey === 'gallery' && $interior !== null) {
    $gallery = gallery_state(
        array_merge($content['assets']['gallery'], $content['assets']['archive_gallery']),
        $interior['filters'],
        24
    );
}
$productCatalog = null;
if (!$isNotFound && $pageKey === 'products' && $interior !== null) {
    $productCatalog = product_catalog_state($content['assets']['products'], 24);
}

$pageView = $isNotFound
    ? 'errors/404'
    : ($isUnavailableLocale ? 'locale-pending' : ($isHome ? 'home' : 'pages/' . $routePage['template']));

return [
    'routeConfig' => $routeConfig,
    'locales' => $locales,
    'site' => $site,
    'content' => $content,
    'formContract' => $formContract,
    'path' => $path,
    'route' => $route,
    'routePage' => $routePage,
    'localizedRoute' => $localizedRoute,
    'locale' => $locale,
    'contentLocale' => $contentLocale,
    'pageKey' => $pageKey,
    'home' => $home,
    'interior' => $interior,
    'isUnavailableLocale' => $isUnavailableLocale,
    'isHome' => $isHome,
    'isNotFound' => $isNotFound,
    'isIndexable' => $isIndexable,
    'pageMeta' => $pageMeta,
    'canonical' => $canonical,
    'heroAsset' => $heroAsset,
    'heroVideo' => $heroVideo,
    'pageHeroAssets' => $pageHeroAssets,
    'navigation' => $navigation,
    'activeNavigationKey' => $activeNavigationKey,
    'breadcrumbs' => $breadcrumbs,
    'sectionNavigation' => $sectionNavigation,
    'gallery' => $gallery,
    'productCatalog' => $productCatalog,
    'pageView' => $pageView,
    'currentYear' => date('Y'),
];
