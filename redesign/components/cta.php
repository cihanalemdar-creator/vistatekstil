<section class="cta-section<?= !empty($compact) ? ' cta-section--compact' : '' ?>" data-reveal data-fixed-control-avoid>
    <div class="shell cta-section__inner">
        <p class="kicker kicker--light"><?= e($eyebrow) ?></p>
        <h2><?= e($title) ?></h2>
        <?php if (!empty($text)): ?><p><?= e($text) ?></p><?php endif; ?>
        <?php render_component('button', ['label' => $buttonLabel, 'href' => $buttonHref, 'variant' => 'light', 'icon' => '↗']); ?>
    </div>
</section>
