<header class="site-header" data-site-header>
    <div class="site-header__inner shell">
        <a class="brand" href="<?= e(route_for($routeConfig, 'home', $locale)) ?>" aria-label="<?= e($site['brand']['name']) ?>">
            <img src="<?= e(asset_url($site['brand']['logo'], true)) ?>" alt="<?= e($site['brand']['name']) ?>">
        </a>

        <nav class="desktop-nav" aria-label="<?= e($home['ui']['mainNav']) ?>">
            <?php foreach ($navigation as $item): ?>
                <a<?= $item['activeKey'] === $activeNavigationKey ? ' aria-current="page"' : '' ?> href="<?= e($item['path']) ?>"><?= e($item['label']) ?></a>
            <?php endforeach; ?>
        </nav>

        <div class="header-actions">
            <?php render_component('language-switcher', compact('home', 'routeConfig', 'locales', 'pageKey', 'locale')); ?>
            <a class="header-contact" href="<?= e(route_for($routeConfig, 'contact', $locale)) ?>#quote-form"><?= e($home['ui']['contact']) ?><span aria-hidden="true">↗</span></a>
        </div>

        <details class="mobile-nav" data-mobile-nav>
            <summary aria-controls="mobile-menu-panel"><span><?= e($home['ui']['menu']) ?></span><i aria-hidden="true"></i></summary>
            <div class="mobile-nav__panel" id="mobile-menu-panel" data-mobile-menu-panel>
                <nav aria-label="<?= e($home['ui']['mobileNav']) ?>">
                    <?php foreach ($navigation as $item): ?>
                        <a<?= $item['activeKey'] === $activeNavigationKey ? ' aria-current="page"' : '' ?> href="<?= e($item['path']) ?>"><?= e($item['label']) ?><span aria-hidden="true">↗</span></a>
                    <?php endforeach; ?>
                </nav>
                <?php render_component('language-switcher', array_merge(compact('home', 'routeConfig', 'locales', 'pageKey', 'locale'), ['mobile' => true])); ?>
            </div>
        </details>
    </div>
</header>
