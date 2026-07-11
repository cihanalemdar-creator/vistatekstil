<?php
declare(strict_types=1);

$routeConfig = require VISTA_REDESIGN_ROOT . '/config/routes.php';
$locales = require VISTA_REDESIGN_ROOT . '/config/locales.php';
$site = require VISTA_REDESIGN_ROOT . '/data/site.php';
$content = require VISTA_REDESIGN_ROOT . '/data/content.php';
$formContract = require VISTA_REDESIGN_ROOT . '/data/form.php';
$path = normalize_path(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');
$locale = preg_match('#^/(en|de|es)(?:/|$)#', $path, $match) === 1 ? $match[1] : 'tr';
$contentLocale = in_array($locale, ['tr', 'en'], true) ? $locale : 'en';
$pageKey = 'home';
$routePage = $routeConfig['pages']['home'];
$localizedRoute = $routePage['locales'][$locale];
$route = ['found' => false, 'pageKey' => $pageKey, 'locale' => $locale, 'page' => $routePage, 'localized' => $localizedRoute];
$home = $content['pages']['home'][$contentLocale];

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
    'interior' => null,
    'isUnavailableLocale' => false,
    'isHome' => false,
    'isNotFound' => true,
    'isIndexable' => false,
    'pageMeta' => [
        'title' => ($contentLocale === 'tr' ? 'Sunucu hatası' : 'Server error') . ' | Vista Moda Tekstil',
        'description' => $contentLocale === 'tr' ? 'Sayfa şu anda görüntülenemiyor.' : 'The page cannot be displayed right now.',
    ],
    'canonical' => 'https://www.vistatekstil.com' . route_for($routeConfig, 'home', $contentLocale),
    'heroAsset' => $content['assets']['hero_factory'],
    'heroVideo' => $content['assets']['hero_videos'][$contentLocale],
    'pageHeroAssets' => [],
    'navigation' => navigation_items($routeConfig, $locale),
    'activeNavigationKey' => null,
    'breadcrumbs' => [],
    'sectionNavigation' => [],
    'gallery' => null,
    'pageView' => 'errors/500',
    'currentYear' => date('Y'),
];
