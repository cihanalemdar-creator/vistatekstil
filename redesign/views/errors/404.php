<section class="page-hero page-hero--error">
    <div class="shell page-hero__inner">
        <p class="kicker">404</p>
        <h1><?= e(localized_text($contentLocale, ['tr' => 'Aradığınız sayfa bulunamadı.', 'en' => 'The page could not be found.', 'de' => 'Die angeforderte Seite wurde nicht gefunden.', 'es' => 'No se ha encontrado la página solicitada.'])) ?></h1>
        <div class="action-row">
            <?php render_component('button', ['label' => $home['ui']['home'], 'href' => route_for($routeConfig, 'home', $contentLocale), 'variant' => 'dark', 'icon' => '→']); ?>
            <a class="text-link" href="<?= e(route_for($routeConfig, 'contact', $contentLocale)) ?>"><?= e(localized_text($contentLocale, ['tr' => 'İletişime geçin', 'en' => 'Contact us', 'de' => 'Kontakt aufnehmen', 'es' => 'Contactar'])) ?><span aria-hidden="true">→</span></a>
        </div>
    </div>
</section>
