<section class="page-hero page-hero--error">
    <div class="shell page-hero__inner">
        <p class="kicker">500</p>
        <h1><?= e($contentLocale === 'tr' ? 'Sayfa şu anda görüntülenemiyor.' : 'The page cannot be displayed right now.') ?></h1>
        <p><?= e($contentLocale === 'tr' ? 'Ana sayfaya dönebilir veya bizimle iletişime geçebilirsiniz.' : 'You can return home or contact our team.') ?></p>
        <div class="action-row">
            <?php render_component('button', ['label' => $home['ui']['home'], 'href' => route_for($routeConfig, 'home', $contentLocale), 'variant' => 'dark', 'icon' => '→']); ?>
            <a class="text-link" href="<?= e(route_for($routeConfig, 'contact', $contentLocale)) ?>"><?= e($contentLocale === 'tr' ? 'İletişime geçin' : 'Contact us') ?><span aria-hidden="true">→</span></a>
        </div>
    </div>
</section>
