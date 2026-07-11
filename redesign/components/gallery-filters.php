<nav class="gallery-filters" aria-label="<?= e($locale === 'tr' ? 'Galeri kategorileri' : 'Gallery categories') ?>">
    <div class="shell">
        <?php foreach ($filters as $filterKey => $filterLabel): ?>
            <a class="<?= $category === $filterKey ? 'is-current' : '' ?>" href="<?= e(query_url(route_for($routeConfig, 'gallery', $locale), ['category' => $filterKey])) ?>"<?= $category === $filterKey ? ' aria-current="page"' : '' ?>><?= e($filterLabel) ?></a>
        <?php endforeach; ?>
    </div>
</nav>
