<?php if ($pageCount > 1): ?>
<nav class="pagination" aria-label="<?= e($locale === 'tr' ? 'Galeri sayfaları' : 'Gallery pages') ?>" data-fixed-control-avoid>
    <?php for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++): ?>
        <a class="<?= $pageNumber === $page ? 'is-current' : '' ?>" href="<?= e(query_url(route_for($routeConfig, 'gallery', $locale), ['category' => $category, 'page' => $pageNumber])) ?>"<?= $pageNumber === $page ? ' aria-current="page"' : '' ?>><?= e($pageNumber) ?></a>
    <?php endfor; ?>
</nav>
<?php endif; ?>
