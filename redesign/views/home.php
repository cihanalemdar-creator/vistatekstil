<section class="home-hero">
    <div class="home-hero__media" data-hero-video>
        <picture class="home-hero__poster" aria-hidden="true">
            <source media="(max-width: 767px)" srcset="<?= e(asset_url($heroVideo['mobile']['poster'])) ?>">
            <img src="<?= e(asset_url($heroVideo['desktop']['poster'])) ?>" alt="" width="1600" height="900" fetchpriority="high" decoding="async">
        </picture>
        <video
            class="home-hero__video"
            autoplay
            muted
            loop
            playsinline
            preload="none"
            poster="<?= e(asset_url($heroVideo['desktop']['poster'])) ?>"
            aria-label="<?= e($heroVideo['title']) ?>"
            data-desktop-webm="<?= e(asset_url($heroVideo['desktop']['webm'])) ?>"
            data-desktop-mp4="<?= e(asset_url($heroVideo['desktop']['mp4'])) ?>"
            data-desktop-poster="<?= e(asset_url($heroVideo['desktop']['poster'])) ?>"
            data-mobile-webm="<?= e(asset_url($heroVideo['mobile']['webm'])) ?>"
            data-mobile-mp4="<?= e(asset_url($heroVideo['mobile']['mp4'])) ?>"
            data-mobile-poster="<?= e(asset_url($heroVideo['mobile']['poster'])) ?>"
        ></video>
    </div>
    <div class="home-hero__shade" aria-hidden="true"></div>
    <div class="home-hero__content shell">
        <div class="home-hero__copy">
            <p class="kicker kicker--light"><?= e($home['hero']['eyebrow']) ?></p>
            <h1><?= e($home['hero']['title']) ?></h1>
            <p class="home-hero__lede"><?= e($home['hero']['lede']) ?></p>
            <div class="action-row">
                <?php render_component('button', ['label' => $home['hero']['primaryCta'], 'href' => route_for($routeConfig, 'design', $locale), 'variant' => 'light', 'icon' => '↗']); ?>
                <a class="text-link text-link--light" href="<?= e(route_for($routeConfig, 'contact', $locale)) ?>#quote-form"><?= e($home['hero']['secondaryCta']) ?><span aria-hidden="true">→</span></a>
            </div>
        </div>
        <div class="home-hero__scope" aria-hidden="true">
            <span><?= e($locale === 'tr' ? 'Yuvarlak örme' : 'Circular knit') ?></span>
            <span><?= e($locale === 'tr' ? 'Dokuma' : 'Woven') ?></span>
            <span><?= e($locale === 'tr' ? 'İstanbul' : 'Istanbul') ?></span>
        </div>
        <div
            class="hero-video-controls"
            data-play-label="<?= e($locale === 'tr' ? 'Videoyu oynat' : 'Play video') ?>"
            data-pause-label="<?= e($locale === 'tr' ? 'Videoyu duraklat' : 'Pause video') ?>"
            data-unmute-label="<?= e($locale === 'tr' ? 'Sesi aç' : 'Turn sound on') ?>"
            data-mute-label="<?= e($locale === 'tr' ? 'Sesi kapat' : 'Mute video') ?>"
        >
            <button class="hero-video-control hero-video-control--play" type="button" aria-label="<?= e($locale === 'tr' ? 'Videoyu oynat' : 'Play video') ?>">
                <span class="hero-video-control__icon" aria-hidden="true">▶</span>
                <span class="hero-video-control__label"><?= e($locale === 'tr' ? 'Videoyu oynat' : 'Play video') ?></span>
            </button>
            <button class="hero-video-control hero-video-control--mute" type="button" aria-label="<?= e($locale === 'tr' ? 'Sesi aç' : 'Turn sound on') ?>" aria-hidden="true" disabled>
                <span class="hero-video-control__icon" aria-hidden="true">M</span>
                <span class="hero-video-control__label"><?= e($locale === 'tr' ? 'Sesi aç' : 'Turn sound on') ?></span>
            </button>
        </div>
    </div>
</section>

<section class="fact-strip" aria-label="<?= e($home['proof']['label']) ?>">
    <div class="shell fact-strip__grid">
        <?php foreach ($site['facts'] as $item): ?>
            <div class="fact"><p><strong><?= e($item['value']) ?></strong><?php if (isset($item['suffix'])): ?><span><?= e($item['suffix'][$contentLocale]) ?></span><?php endif; ?></p><small><?= e($item['label'][$contentLocale]) ?></small></div>
        <?php endforeach; ?>
    </div>
    <p class="shell fact-strip__note"><?= e($home['proof']['note']) ?></p>
</section>

<section class="section company-intro" data-reveal><div class="shell editorial-grid">
    <div class="section-heading"><p class="kicker"><?= e($home['about']['eyebrow']) ?></p><h2><?= e($home['about']['title']) ?></h2></div>
    <div class="editorial-grid__body"><?php foreach ($home['about']['paragraphs'] as $paragraph): ?><p><?= e($paragraph) ?></p><?php endforeach; ?><a class="text-link" href="<?= e(route_for($routeConfig, 'about', $locale)) ?>"><?= e($home['about']['link']) ?><span aria-hidden="true">→</span></a></div>
</div></section>

<section class="section products-section" data-reveal><div class="shell">
    <div class="section-heading section-heading--wide"><p class="kicker"><?= e($home['products']['eyebrow']) ?></p><h2><?= e($home['products']['title']) ?></h2><p><?= e($home['products']['intro']) ?></p></div>
    <div class="product-grid">
        <?php foreach ($home['products']['items'] as $index => $product): $productAsset = $content['assets']['home_products'][$product['key']]; ?>
            <article class="product-card"><div class="product-card__media"><img src="<?= e(asset_url($productAsset)) ?>" alt="<?= e(asset_alt($productAsset, $locale)) ?>" loading="lazy" width="915" height="540"><span aria-hidden="true">0<?= e($index + 1) ?></span></div><h3><?= e($product['title']) ?></h3><p><?= e($product['text']) ?></p></article>
        <?php endforeach; ?>
    </div>
    <a class="text-link products-section__link" href="<?= e(route_for($routeConfig, 'products', $locale)) ?>"><?= e($home['products']['link']) ?><span aria-hidden="true">→</span></a>
</div></section>

<section class="capabilities-section" data-reveal><div class="shell capabilities-grid">
    <div class="capabilities-gallery" aria-label="<?= e($home['capabilities']['eyebrow']) ?>">
        <?php foreach (['design', 'cutting', 'sewing', 'sampling'] as $assetKey): $processAsset = $content['assets']['process'][$assetKey]; ?><img src="<?= e(asset_url($processAsset)) ?>" alt="<?= e(asset_alt($processAsset, $locale)) ?>" loading="lazy"><?php endforeach; ?>
    </div>
    <div class="capabilities-copy"><p class="kicker kicker--light"><?= e($home['capabilities']['eyebrow']) ?></p><h2><?= e($home['capabilities']['title']) ?></h2><p class="capabilities-copy__intro"><?= e($home['capabilities']['intro']) ?></p>
        <div class="capability-list"><?php foreach ($home['capabilities']['items'] as $item): ?><article><span><?= e($item['number']) ?></span><div><h3><?= e($item['title']) ?></h3><p><?= e($item['text']) ?></p></div></article><?php endforeach; ?></div>
        <a class="text-link text-link--light" href="<?= e(route_for($routeConfig, 'design', $locale)) ?>"><?= e($home['capabilities']['link']) ?><span aria-hidden="true">→</span></a>
    </div>
</div></section>

<section class="section process-section" data-reveal><div class="shell"><div class="section-heading section-heading--split"><p class="kicker"><?= e($home['process']['eyebrow']) ?></p><h2><?= e($home['process']['title']) ?></h2></div><ol class="process-list"><?php foreach ($home['process']['items'] as $index => $item): ?><li><span>0<?= e($index + 1) ?></span><h3><?= e($item['title']) ?></h3><p><?= e($item['text']) ?></p></li><?php endforeach; ?></ol></div></section>

<section class="home-collection section" data-reveal><div class="shell home-collection__grid">
    <div class="home-collection__copy"><p class="kicker"><?= e($home['collection']['eyebrow']) ?></p><h2><?= e($home['collection']['title']) ?></h2><p><?= e($home['collection']['text']) ?></p><a class="text-link" href="<?= e(route_for($routeConfig, 'collection', $locale)) ?>"><?= e($home['collection']['link']) ?><span aria-hidden="true">→</span></a></div>
    <div class="home-collection__media"><?php foreach (array_slice($content['assets']['collection'], 0, 4) as $collectionAsset): ?><img src="<?= e(asset_url($collectionAsset)) ?>" alt="<?= e(asset_alt($collectionAsset, $locale)) ?>" loading="lazy"><?php endforeach; ?></div>
</div></section>

<section class="markets-section" data-reveal><div class="shell markets-grid"><div><p class="kicker"><?= e($home['markets']['eyebrow']) ?></p><h2><?= e($home['markets']['title']) ?></h2><p><?= e($home['markets']['text']) ?></p></div><ul><?php foreach ($site['markets'] as $market): ?><li><?= e($market[$contentLocale]) ?></li><?php endforeach; ?></ul></div></section>

<section class="section quality-section" data-reveal><div class="shell quality-grid">
    <div class="quality-media"><?php $qualityAsset = $content['assets']['process']['quality']; ?><img src="<?= e(asset_url($qualityAsset)) ?>" alt="<?= e(asset_alt($qualityAsset, $locale)) ?>" loading="lazy"></div>
    <div class="quality-copy"><p class="kicker"><?= e($home['quality']['eyebrow']) ?></p><h2><?= e($home['quality']['title']) ?></h2><?php foreach ($home['quality']['paragraphs'] as $paragraph): ?><p><?= e($paragraph) ?></p><?php endforeach; ?><a class="text-link" href="<?= e(route_for($routeConfig, 'about', $locale)) ?>"><?= e($home['quality']['link']) ?><span aria-hidden="true">→</span></a></div>
</div></section>

<section class="video-section" data-reveal><div class="shell video-section__grid">
    <div class="video-section__copy"><p class="kicker kicker--light"><?= e($home['video']['eyebrow']) ?></p><h2><?= e($home['video']['title']) ?></h2><p><?= e($home['video']['text']) ?></p></div>
    <?php $video = $content['assets']['videos'][$locale]; ?>
    <div class="video-player"><video controls preload="none" playsinline poster="<?= e(asset_url($video['poster'])) ?>" aria-label="<?= e($video['title']) ?>"><source src="<?= e(asset_url($video['src'])) ?>" type="video/mp4"></video></div>
</div></section>

<?php render_component('cta', [
    'eyebrow' => $home['cta']['eyebrow'],
    'title' => $home['cta']['title'],
    'text' => $home['cta']['text'],
    'buttonLabel' => $home['cta']['button'],
    'buttonHref' => route_for($routeConfig, 'contact', $locale) . '#quote-form',
]); ?>
