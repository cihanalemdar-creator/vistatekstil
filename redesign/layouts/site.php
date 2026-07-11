<!doctype html>
<html lang="<?= e($locales[$locale]['htmlLang']) ?>">
<?php render_component('head', get_defined_vars()); ?>
<body data-page="<?= e($isNotFound ? 'error' : $pageKey) ?>">
<a class="skip-link" href="#main"><?= e($home['ui']['skip']) ?></a>

<?php render_component('header', get_defined_vars()); ?>

<main id="main">
    <?php render_view($pageView, get_defined_vars()); ?>
    <?php if (!$isHome && !$isNotFound && !$isUnavailableLocale && $pageKey !== 'contact'): ?>
        <?php render_component('cta', [
            'eyebrow' => $home['cta']['eyebrow'],
            'title' => $home['cta']['title'],
            'text' => null,
            'buttonLabel' => $home['cta']['button'],
            'buttonHref' => route_for($routeConfig, 'contact', $locale) . '#quote-form',
            'compact' => true,
        ]); ?>
    <?php endif; ?>
</main>

<?php render_component('footer', get_defined_vars()); ?>
<?php render_component('floating-controls', ['locale' => $locale]); ?>

<?php if (!$isUnavailableLocale && !$isNotFound): ?>
<script type="application/ld+json"><?= json_encode($content['schema']['organization'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?></script>
<?php endif; ?>
</body>
</html>
