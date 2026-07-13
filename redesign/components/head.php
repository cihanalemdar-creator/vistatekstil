<?php
/** @var array $pageMeta */
/** @var array $routeConfig */
/** @var array $locales */
/** @var array $site */
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title><?= e($pageMeta['title']) ?></title>
    <meta name="description" content="<?= e($pageMeta['description']) ?>">
    <meta name="robots" content="<?= $isIndexable ? 'index,follow' : 'noindex,nofollow' ?>">
    <link rel="canonical" href="<?= e($canonical) ?>">
    <?php if ($route['found'] && !$isUnavailableLocale): ?>
        <?php foreach (array_keys($locales) as $alternateLocale): ?>
            <?php if ((isset($routeConfig['pages'][$pageKey]['locales'][$alternateLocale]['publicationStatus']) ? $routeConfig['pages'][$pageKey]['locales'][$alternateLocale]['publicationStatus'] : 'unavailable') !== 'unavailable'): ?>
                <link rel="alternate" hreflang="<?= e($locales[$alternateLocale]['hreflang']) ?>" href="https://www.vistatekstil.com<?= e(route_for($routeConfig, $pageKey, $alternateLocale)) ?>">
            <?php endif; ?>
        <?php endforeach; ?>
        <link rel="alternate" hreflang="x-default" href="https://www.vistatekstil.com<?= e(route_for($routeConfig, $pageKey, 'tr')) ?>">
    <?php endif; ?>
    <meta property="og:title" content="<?= e($pageMeta['title']) ?>">
    <meta property="og:description" content="<?= e($pageMeta['description']) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= e($canonical) ?>">
    <meta name="theme-color" content="#121c33">
    <link rel="icon" href="<?= e(asset_url($site['brand']['logo'], true)) ?>" type="image/png">
    <link rel="preload" href="<?= e(asset_url('redesign/assets/fonts/manrope-latin.woff2', true)) ?>" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?= e(asset_url('redesign/assets/fonts/manrope-latin-ext.woff2', true)) ?>" as="font" type="font/woff2" crossorigin>
    <?php if ($isHome): ?>
        <link rel="preload" href="<?= e(asset_url($heroVideo['mobile']['poster'])) ?>" as="image" type="image/webp" media="(max-width: 767px)" fetchpriority="high">
        <link rel="preload" href="<?= e(asset_url($heroVideo['desktop']['poster'])) ?>" as="image" type="image/webp" media="(min-width: 768px)" fetchpriority="high">
    <?php endif; ?>
    <link rel="stylesheet" href="<?= e(asset_url('redesign/assets/css/styles.css', true)) ?>">
    <script src="<?= e(asset_url('redesign/assets/js/site.js', true)) ?>" defer></script>
    <?php if ($isHome): ?><script src="<?= e(asset_url('redesign/assets/js/hero-video.js', true)) ?>" defer></script><?php endif; ?>
</head>
