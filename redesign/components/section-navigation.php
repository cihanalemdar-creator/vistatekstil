<?php if (!empty($items)): ?>
<nav class="section-navigation" aria-label="<?= e(localized_text($locale, ['tr' => 'Sayfa bölümleri', 'en' => 'Page sections', 'de' => 'Seitenabschnitte', 'es' => 'Secciones de la página'])) ?>">
    <div class="shell">
        <?php foreach ($items as $item): ?><a href="#<?= e($item['id']) ?>"><?= e($item['label']) ?></a><?php endforeach; ?>
    </div>
</nav>
<?php endif; ?>
