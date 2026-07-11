<section class="locale-pending">
    <div class="shell locale-pending__inner">
        <p class="kicker"><?= e($locale === 'de' ? 'Deutsch' : 'Español') ?></p>
        <h1><?= e($locale === 'de' ? 'Die deutsche Version wird vorbereitet.' : 'La versión en español está en preparación.') ?></h1>
        <p><?= e($locale === 'de' ? 'Die vollständigen Inhalte sind derzeit auf Türkisch und Englisch verfügbar.' : 'El contenido completo está disponible actualmente en turco e inglés.') ?></p>
        <div class="action-row">
            <?php render_component('button', ['label' => 'English', 'href' => route_for($routeConfig, $pageKey, 'en'), 'variant' => 'dark']); ?>
            <a class="text-link" href="<?= e(route_for($routeConfig, $pageKey, 'tr')) ?>">Türkçe <span aria-hidden="true">→</span></a>
        </div>
    </div>
</section>
