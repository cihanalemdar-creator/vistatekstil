<?php $selectionLabel = localized_text($locale, ['tr' => 'Ürün seçkisi', 'en' => 'Product selection', 'de' => 'Produktauswahl', 'es' => 'Selección de productos']); ?>
<?php render_component('page-hero', ['asset' => $pageHeroAssets['collection'], 'breadcrumbs' => $breadcrumbs, 'interior' => $interior, 'locale' => $locale]); ?>

<section class="collection-intro"><div class="shell collection-intro__inner"><p><?= e($selectionLabel) ?></p><ul><?php foreach ($interior['categories'] as $category): ?><li><?= e($category) ?></li><?php endforeach; ?></ul></div></section>
<section class="collection-editorial section"><div class="shell collection-editorial__grid">
    <?php foreach ($content['assets']['collection'] as $index => $collectionAsset): ?><figure class="<?= $index === 0 ? 'collection-editorial__feature' : '' ?>" data-reveal><img src="<?= e(asset_url($collectionAsset)) ?>" alt="<?= e(asset_alt($collectionAsset, $locale)) ?>" loading="<?= $index < 2 ? 'eager' : 'lazy' ?>"><figcaption><span><?= e(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)) ?></span><?= e(asset_alt($collectionAsset, $locale)) ?></figcaption></figure><?php endforeach; ?>
</div></section>
