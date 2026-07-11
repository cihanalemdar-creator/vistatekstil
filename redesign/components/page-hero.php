<section class="page-hero page-hero--media">
    <div class="page-hero__media" aria-hidden="true"><img src="<?= e(asset_url($asset)) ?>" alt="" fetchpriority="high"></div>
    <div class="page-hero__shade" aria-hidden="true"></div>
    <div class="shell page-hero__inner">
        <?php render_component('breadcrumb', ['items' => $breadcrumbs, 'locale' => $locale]); ?>
        <p class="kicker kicker--light"><?= e($interior['eyebrow']) ?></p>
        <h1><?= e($interior['title']) ?></h1>
        <p><?= e($interior['intro']) ?></p>
    </div>
</section>
