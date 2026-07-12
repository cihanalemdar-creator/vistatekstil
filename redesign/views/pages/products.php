<?php
$viewModelsLabel = localized_text($locale, ['tr' => 'Tüm modelleri görün', 'en' => 'View all styles', 'de' => 'Alle Modelle ansehen', 'es' => 'Ver todos los modelos']);
$viewCollectionLabel = localized_text($locale, ['tr' => 'Koleksiyonu inceleyin', 'en' => 'Explore the collection', 'de' => 'Kollektion ansehen', 'es' => 'Explorar la colección']);
$requestQuoteLabel = localized_text($locale, ['tr' => 'Teklif isteyin', 'en' => 'Request a quote', 'de' => 'Angebot anfragen', 'es' => 'Solicitar presupuesto']);
$catalogueLabel = localized_text($locale, ['tr' => 'Ürün Kataloğu', 'en' => 'Product Catalogue', 'de' => 'Produktkatalog', 'es' => 'Catálogo de productos']);
$modelLabel = localized_text($locale, ['tr' => 'model', 'en' => 'styles', 'de' => 'Modelle', 'es' => 'modelos']);
$cataloguePagesLabel = localized_text($locale, ['tr' => 'Ürün kataloğu sayfaları', 'en' => 'Product catalogue pages', 'de' => 'Produktkatalogseiten', 'es' => 'Páginas del catálogo']);
?>
<?php render_component('page-hero', ['asset' => $pageHeroAssets['products'], 'breadcrumbs' => $breadcrumbs, 'interior' => $interior, 'locale' => $locale]); ?>
<?php render_component('section-navigation', ['items' => $sectionNavigation, 'locale' => $locale]); ?>

<div class="product-categories">
    <?php foreach ($interior['sections'] as $index => $section): $productAssets = $content['assets']['products'][$section['key']]; ?>
        <section class="product-category section" id="<?= e($section['id']) ?>" data-reveal><div class="shell product-category__grid">
            <div class="product-category__media"><?php foreach (array_slice($productAssets, 0, 3) as $productImage): ?><img src="<?= e(asset_url($productImage)) ?>" alt="<?= e(asset_alt($productImage, $locale)) ?>" loading="lazy"><?php endforeach; ?></div>
            <div class="product-category__copy"><p class="kicker">0<?= e($index + 1) ?> / <?= e($interior['eyebrow']) ?></p><h2><?= e($section['title']) ?></h2><p><?= e($section['text']) ?></p><p class="product-context"><?= e($section['context']) ?></p><ul><?php foreach ($section['examples'] as $example): ?><li><?= e($example) ?></li><?php endforeach; ?></ul><div class="action-row"><?php if (in_array($section['key'], ['womenswear', 'menswear', 'kidswear'], true)): ?><a class="text-link" href="<?= e(query_url(route_for($routeConfig, 'products', $locale), ['category' => $section['key']], 'product-catalog')) ?>"><?= e($viewModelsLabel) ?><span aria-hidden="true">→</span></a><?php endif; ?><a class="text-link" href="<?= e(route_for($routeConfig, 'collection', $locale)) ?>"><?= e($viewCollectionLabel) ?><span aria-hidden="true">→</span></a><a class="text-link" href="<?= e(route_for($routeConfig, 'contact', $locale)) ?>#quote-form"><?= e($requestQuoteLabel) ?><span aria-hidden="true">↗</span></a></div></div>
        </div></section>
        <?php if ($productCatalog !== null && $productCatalog['category'] === $section['key']): ?>
            <section class="product-catalog section" id="product-catalog"><div class="shell">
                <div class="product-catalog__heading"><div><p class="kicker"><?= e($catalogueLabel) ?></p><h2><?= e($section['title']) ?></h2></div><p><?= e($productCatalog['total'] . ' ' . $modelLabel) ?></p></div>
                <div class="product-catalog__grid" data-lightbox-gallery>
                    <?php foreach ($productCatalog['items'] as $productImage): ?>
                        <figure><a href="<?= e(asset_url($productImage)) ?>" target="_blank" rel="noopener" data-lightbox-item data-lightbox-src="<?= e(asset_url($productImage)) ?>" data-lightbox-title="<?= e($section['title']) ?>" data-lightbox-description="<?= e(asset_alt($productImage, $locale)) ?>"><?php render_component('responsive-image', ['asset' => $productImage, 'locale' => $locale]); ?></a><figcaption><?= e(asset_alt($productImage, $locale)) ?></figcaption></figure>
                    <?php endforeach; ?>
                </div>
                <?php render_component('pagination', ['pageCount' => $productCatalog['pageCount'], 'page' => $productCatalog['page'], 'category' => $productCatalog['category'], 'routeConfig' => $routeConfig, 'routeKey' => 'products', 'fragment' => 'product-catalog', 'ariaLabel' => $cataloguePagesLabel, 'locale' => $locale]); ?>
            </div></section>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<?php if ($productCatalog !== null): ?><?php render_component('lightbox', ['locale' => $locale]); ?><?php endif; ?>
