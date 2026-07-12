<?php
$closeLabel = localized_text($locale, ['tr' => 'Görseli kapat', 'en' => 'Close image', 'de' => 'Bild schließen', 'es' => 'Cerrar imagen']);
$previousLabel = localized_text($locale, ['tr' => 'Önceki görsel', 'en' => 'Previous image', 'de' => 'Vorheriges Bild', 'es' => 'Imagen anterior']);
$nextLabel = localized_text($locale, ['tr' => 'Sonraki görsel', 'en' => 'Next image', 'de' => 'Nächstes Bild', 'es' => 'Imagen siguiente']);
?>
<dialog class="lightbox" data-lightbox aria-labelledby="lightbox-title" aria-describedby="lightbox-description">
    <div class="lightbox__surface">
        <header class="lightbox__header">
            <div><p class="lightbox__count" data-lightbox-count></p><h2 id="lightbox-title" data-lightbox-title></h2></div>
            <button class="icon-button lightbox__close" type="button" aria-label="<?= e($closeLabel) ?>" data-lightbox-close><span aria-hidden="true">×</span></button>
        </header>
        <div class="lightbox__stage">
            <button class="icon-button lightbox__previous" type="button" aria-label="<?= e($previousLabel) ?>" data-lightbox-previous><span aria-hidden="true">←</span></button>
            <figure><img src="" alt="" data-lightbox-image><figcaption id="lightbox-description" data-lightbox-description></figcaption></figure>
            <button class="icon-button lightbox__next" type="button" aria-label="<?= e($nextLabel) ?>" data-lightbox-next><span aria-hidden="true">→</span></button>
        </div>
    </div>
</dialog>
