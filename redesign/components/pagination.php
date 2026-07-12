<?php
$routeKey = $routeKey ?? 'gallery';
$fragment = $fragment ?? null;
$ariaLabel = $ariaLabel ?? ($locale === 'tr' ? 'Galeri sayfaları' : 'Gallery pages');
?>
<?php if ($pageCount > 1): ?>
<nav class="pagination" aria-label="<?= e($ariaLabel) ?>" data-fixed-control-avoid>
    <?php for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++): ?>
        <a class="<?= $pageNumber === $page ? 'is-current' : '' ?>" href="<?= e(query_url(route_for($routeConfig, $routeKey, $locale), ['category' => $category, 'page' => $pageNumber], $fragment)) ?>"<?= $pageNumber === $page ? ' aria-current="page"' : '' ?>><?= e($pageNumber) ?></a>
    <?php endfor; ?>
</nav>
<?php endif; ?>
