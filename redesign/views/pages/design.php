<?php render_component('page-hero', ['asset' => $pageHeroAssets['design'], 'breadcrumbs' => $breadcrumbs, 'interior' => $interior, 'locale' => $locale]); ?>
<?php render_component('section-navigation', ['items' => $sectionNavigation, 'locale' => $locale]); ?>

<section class="design-process section"><div class="shell">
    <?php foreach ($interior['sections'] as $index => $section): $processImage = $content['assets']['process'][$section['asset']]; ?>
        <article class="design-step" id="<?= e($section['asset']) ?>" data-reveal><div class="design-step__media"><img src="<?= e(asset_url($processImage)) ?>" alt="<?= e(asset_alt($processImage, $locale)) ?>" loading="lazy"></div><div class="design-step__copy"><span>0<?= e($index + 1) ?></span><h2><?= e($section['title']) ?></h2><p><?= e($section['text']) ?></p></div></article>
    <?php endforeach; ?>
</div></section>

<section class="video-section video-section--interior" data-reveal><div class="shell video-section__grid"><div class="video-section__copy"><p class="kicker kicker--light"><?= e($home['video']['eyebrow']) ?></p><h2><?= e($home['video']['title']) ?></h2><p><?= e($home['video']['text']) ?></p></div><?php $video = $content['assets']['videos'][$locale]; ?><div class="video-player"><video controls preload="none" playsinline poster="<?= e(asset_url($video['poster'])) ?>" aria-label="<?= e($video['title']) ?>"><source src="<?= e(asset_url($video['src'])) ?>" type="video/mp4"></video></div></div></section>
