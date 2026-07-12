<nav class="gallery-filters" aria-label="<?= e(localized_text($locale, ['tr' => 'Galeri kategorileri', 'en' => 'Gallery categories', 'de' => 'Galeriekategorien', 'es' => 'Categorías de la galería'])) ?>">
    <div class="shell">
        <?php foreach ($filters as $filterKey => $filterLabel): ?>
            <a class="<?= $category === $filterKey ? 'is-current' : '' ?>" href="<?= e(query_url(route_for($routeConfig, 'gallery', $locale), ['category' => $filterKey])) ?>"<?= $category === $filterKey ? ' aria-current="page"' : '' ?>><?= e($filterLabel) ?></a>
        <?php endforeach; ?>
    </div>
</nav>
