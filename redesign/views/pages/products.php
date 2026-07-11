<?php render_component('page-hero', ['asset' => $pageHeroAssets['products'], 'breadcrumbs' => $breadcrumbs, 'interior' => $interior, 'locale' => $locale]); ?>
<?php render_component('section-navigation', ['items' => $sectionNavigation, 'locale' => $locale]); ?>

<div class="product-categories">
    <?php foreach ($interior['sections'] as $index => $section): $productAssets = $content['assets']['products'][$section['key']]; ?>
        <section class="product-category section" id="<?= e($section['id']) ?>" data-reveal><div class="shell product-category__grid">
            <div class="product-category__media"><?php foreach (array_slice($productAssets, 0, 3) as $productImage): ?><img src="<?= e(asset_url($productImage)) ?>" alt="<?= e(asset_alt($productImage, $locale)) ?>" loading="lazy"><?php endforeach; ?></div>
            <div class="product-category__copy"><p class="kicker">0<?= e($index + 1) ?> / <?= e($interior['eyebrow']) ?></p><h2><?= e($section['title']) ?></h2><p><?= e($section['text']) ?></p><p class="product-context"><?= e($section['context']) ?></p><ul><?php foreach ($section['examples'] as $example): ?><li><?= e($example) ?></li><?php endforeach; ?></ul><div class="action-row"><a class="text-link" href="<?= e(route_for($routeConfig, 'collection', $locale)) ?>"><?= e($locale === 'tr' ? 'Koleksiyonu inceleyin' : 'Explore the collection') ?><span aria-hidden="true">→</span></a><a class="text-link" href="<?= e(route_for($routeConfig, 'contact', $locale)) ?>#quote-form"><?= e($locale === 'tr' ? 'Teklif isteyin' : 'Request a quote') ?><span aria-hidden="true">↗</span></a></div></div>
        </div></section>
    <?php endforeach; ?>
</div>
