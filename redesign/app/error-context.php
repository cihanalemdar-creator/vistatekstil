<?php

$routeConfig = require VISTA_REDESIGN_ROOT . '/config/routes.php';
$locales = require VISTA_REDESIGN_ROOT . '/config/locales.php';
$site = require VISTA_REDESIGN_ROOT . '/data/site.php';
$content = require VISTA_REDESIGN_ROOT . '/data/content.php';
$formContract = require VISTA_REDESIGN_ROOT . '/data/form.php';
$path = normalize_path(parse_url(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/', PHP_URL_PATH) ?: '/');
$locale = preg_match('#^/(en|de|es)(?:/|$)#', $path, $match) === 1 ? $match[1] : 'tr';
$contentLocale = isset($content['pages']['home'][$locale]) ? $locale : 'en';
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
        'title' => localized_text($contentLocale, ['tr' => 'Sunucu hatası', 'en' => 'Server error', 'de' => 'Serverfehler', 'es' => 'Error del servidor']) . ' | Vista Moda Tekstil',
        'description' => localized_text($contentLocale, ['tr' => 'Sayfa şu anda görüntülenemiyor.', 'en' => 'The page cannot be displayed right now.', 'de' => 'Die Seite kann derzeit nicht angezeigt werden.', 'es' => 'La página no se puede mostrar en este momento.']),
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
