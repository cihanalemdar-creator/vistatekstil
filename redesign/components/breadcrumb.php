<?php if (!empty($items)): ?>
<nav class="breadcrumb" aria-label="<?= e(localized_text($locale, ['tr' => 'İçerik yolu', 'en' => 'Breadcrumb', 'de' => 'Brotkrümelnavigation', 'es' => 'Ruta de navegación'])) ?>">
    <ol>
        <?php foreach ($items as $index => $item): ?>
            <li>
                <?php if ($item['href'] !== null): ?><a href="<?= e($item['href']) ?>"><?= e($item['label']) ?></a><?php else: ?><span aria-current="page"><?= e($item['label']) ?></span><?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
<?php endif; ?>
