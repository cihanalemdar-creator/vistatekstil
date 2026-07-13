<?php
$galleryImageLabel = localized_text($locale, ['tr' => 'görsel', 'en' => 'images', 'de' => 'Bilder', 'es' => 'imágenes']);
$galleryPageLabel = localized_text($locale, ['tr' => 'Sayfa', 'en' => 'Page', 'de' => 'Seite', 'es' => 'Página']);
?>
<?php render_component('page-hero', ['asset' => $pageHeroAssets['gallery'], 'breadcrumbs' => $breadcrumbs, 'interior' => $interior, 'locale' => $locale]); ?>
<?php render_component('gallery-filters', ['filters' => $interior['filters'], 'category' => $gallery['category'], 'routeConfig' => $routeConfig, 'locale' => $locale]); ?>

<section class="gallery-archive section"><div class="shell">
    <div class="gallery-archive__meta"><p><?= e($gallery['total'] . ' ' . $galleryImageLabel) ?></p><p><?= e($galleryPageLabel . ' ' . $gallery['page'] . ' / ' . $gallery['pageCount']) ?></p></div>
    <div class="gallery-masonry" data-lightbox-gallery>
        <?php foreach ($gallery['items'] as $galleryAsset): $categoryLabel = isset($interior['filters'][$galleryAsset['category']]) ? $interior['filters'][$galleryAsset['category']] : $interior['filters']['products']; ?>
            <figure data-reveal><a href="<?= e(asset_url($galleryAsset)) ?>" target="_blank" rel="noopener" data-lightbox-item data-lightbox-src="<?= e(asset_url($galleryAsset)) ?>" data-lightbox-title="<?= e($categoryLabel) ?>" data-lightbox-description="<?= e(asset_alt($galleryAsset, $locale)) ?>"><?php render_component('responsive-image', ['asset' => $galleryAsset, 'locale' => $locale]); ?></a><figcaption data-fixed-control-collision><?= e($categoryLabel) ?></figcaption></figure>
        <?php endforeach; ?>
    </div>
    <?php render_component('pagination', ['pageCount' => $gallery['pageCount'], 'page' => $gallery['page'], 'category' => $gallery['category'], 'routeConfig' => $routeConfig, 'locale' => $locale]); ?>
</div></section>

<?php render_component('lightbox', ['locale' => $locale]); ?>
