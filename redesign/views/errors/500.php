<section class="page-hero page-hero--error">
    <div class="shell page-hero__inner">
        <p class="kicker">500</p>
        <h1><?= e(localized_text($contentLocale, ['tr' => 'Sayfa şu anda görüntülenemiyor.', 'en' => 'The page cannot be displayed right now.', 'de' => 'Die Seite kann derzeit nicht angezeigt werden.', 'es' => 'La página no se puede mostrar en este momento.'])) ?></h1>
        <p><?= e(localized_text($contentLocale, ['tr' => 'Ana sayfaya dönebilir veya bizimle iletişime geçebilirsiniz.', 'en' => 'You can return home or contact our team.', 'de' => 'Sie können zur Startseite zurückkehren oder unser Team kontaktieren.', 'es' => 'Puede volver al inicio o contactar con nuestro equipo.'])) ?></p>
        <div class="action-row">
            <?php render_component('button', ['label' => $home['ui']['home'], 'href' => route_for($routeConfig, 'home', $contentLocale), 'variant' => 'dark', 'icon' => '→']); ?>
            <a class="text-link" href="<?= e(route_for($routeConfig, 'contact', $contentLocale)) ?>"><?= e(localized_text($contentLocale, ['tr' => 'İletişime geçin', 'en' => 'Contact us', 'de' => 'Kontakt aufnehmen', 'es' => 'Contactar'])) ?><span aria-hidden="true">→</span></a>
        </div>
    </div>
</section>
