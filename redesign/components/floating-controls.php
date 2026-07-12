<div class="fixed-control-stack" data-fixed-controls>
    <?php $backToTopLabel = localized_text($locale, ['tr' => 'Yukarı çık', 'en' => 'Back to top', 'de' => 'Nach oben', 'es' => 'Volver arriba']); ?>
    <button class="floating-control back-to-top" type="button" aria-label="<?= e($backToTopLabel) ?>" title="<?= e($backToTopLabel) ?>" data-back-to-top hidden>
        <span aria-hidden="true">↑</span>
    </button>
</div>
