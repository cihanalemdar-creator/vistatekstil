<?php if (!empty($items)): ?>
<nav class="section-navigation" aria-label="<?= e($locale === 'tr' ? 'Sayfa bölümleri' : 'Page sections') ?>">
    <div class="shell">
        <?php foreach ($items as $item): ?><a href="#<?= e($item['id']) ?>"><?= e($item['label']) ?></a><?php endforeach; ?>
    </div>
</nav>
<?php endif; ?>
