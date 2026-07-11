<footer class="site-footer" id="site-footer" data-site-footer>
    <div class="shell site-footer__top">
        <div class="footer-brand"><img src="<?= e(asset_url($site['brand']['logo'], true)) ?>" alt="<?= e($site['brand']['name']) ?>"><p><?= e($home['footer']['summary']) ?></p></div>
        <nav aria-label="<?= e($home['ui']['footerNav']) ?>"><h2><?= e($home['footer']['pages']) ?></h2><?php foreach ($navigation as $item): ?><a href="<?= e($item['path']) ?>"><?= e($item['label']) ?></a><?php endforeach; ?></nav>
        <address><h2><?= e($home['footer']['contact']) ?></h2><a href="mailto:<?= e($site['contact']['email']) ?>"><?= e($site['contact']['email']) ?></a><a href="tel:<?= e($site['contact']['phoneHref']) ?>"><?= e($site['contact']['phone']) ?></a><a href="tel:<?= e($site['contact']['secondaryPhoneHref']) ?>"><?= e($site['contact']['secondaryPhone']) ?></a><p><?= e($site['contact']['officeAddress']) ?></p></address>
    </div>
    <div class="shell site-footer__bottom"><p>© <?= e($currentYear) ?> <?= e($site['brand']['name']) ?>. <?= e($home['footer']['copyright']) ?></p><p><?= e($site['contact']['hours'][$contentLocale]) ?></p></div>
</footer>
