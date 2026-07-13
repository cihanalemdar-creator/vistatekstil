<?php render_component('page-hero', ['asset' => $pageHeroAssets['about'], 'breadcrumbs' => $breadcrumbs, 'interior' => $interior, 'locale' => $locale]); ?>
<?php render_component('section-navigation', ['items' => $sectionNavigation, 'locale' => $locale]); ?>

<section class="about-facts"><div class="shell about-facts__grid">
    <?php foreach ($site['facts'] as $fact): ?><div><strong><?= e($fact['value']) ?></strong><span><?= e($fact['shortLabel'][$contentLocale]) ?></span></div><?php endforeach; ?>
</div></section>

<section class="about-story section"><div class="shell">
    <?php
    $aboutAssetMap = [
        'facility' => isset($content['assets']['gallery'][1]) ? $content['assets']['gallery'][1] : $heroAsset,
        'founder' => isset($content['assets']['gallery'][2]) ? $content['assets']['gallery'][2] : $heroAsset,
        'production' => $content['assets']['process']['sewing'],
        'design' => $content['assets']['process']['design'],
        'sampling' => $content['assets']['process']['sampling'],
        'cutting' => $content['assets']['process']['cutting'],
        'markets' => isset($content['assets']['gallery'][18]) ? $content['assets']['gallery'][18] : $heroAsset,
        'quality' => $content['assets']['process']['quality'],
        'partnership' => isset($content['assets']['gallery'][3]) ? $content['assets']['gallery'][3] : $heroAsset,
    ];
    ?>
    <?php foreach ($interior['sections'] as $index => $section): $sectionAsset = isset($aboutAssetMap[$section['asset']]) ? $aboutAssetMap[$section['asset']] : $heroAsset; ?>
        <article class="about-story__item" id="<?= e($section['asset']) ?>" data-reveal>
            <div class="about-story__media"><img src="<?= e(asset_url($sectionAsset)) ?>" alt="<?= e(asset_alt($sectionAsset, $locale)) ?>" loading="lazy"></div>
            <div class="about-story__copy"><span>0<?= e($index + 1) ?></span><h2><?= e($section['title']) ?></h2><p><?= e($section['text']) ?></p><?php if ($section['asset'] === 'quality'): $certificationAsset = $content['assets']['certifications']; ?><img class="certification-strip" src="<?= e(asset_url($certificationAsset)) ?>" alt="<?= e(asset_alt($certificationAsset, $locale)) ?>" loading="lazy"><?php endif; ?></div>
        </article>
    <?php endforeach; ?>
</div></section>
