<?php $labels = $contract['labels'][$locale]; ?>
<form class="quote-form" action="#quote-form" method="post" enctype="multipart/form-data" novalidate data-quote-form data-fixed-control-avoid>
    <div class="quote-form__basic">
        <?php foreach ($contract['groups']['basic'] as $fieldName): ?>
            <?php render_component('form-field', ['name' => $fieldName, 'contract' => $contract, 'labels' => $labels, 'locale' => $locale]); ?>
        <?php endforeach; ?>
    </div>

    <details class="form-details" data-form-details>
        <summary><span><?= e($labels['details']) ?></span><small><?= e($labels['detailsHint']) ?></small></summary>
        <div class="form-details__grid">
            <?php foreach ($contract['groups']['details'] as $fieldName): ?>
                <?php render_component('form-field', ['name' => $fieldName, 'contract' => $contract, 'labels' => $labels, 'locale' => $locale]); ?>
            <?php endforeach; ?>
        </div>
    </details>

    <label class="privacy-field"><input type="checkbox" name="privacy" required><span><?= e($interior['privacy']) ?> *</span></label>
    <div class="form-status form-status--success" aria-live="polite" hidden></div>
    <div class="form-status form-status--error" aria-live="assertive" hidden></div>
    <?php render_component('button', ['label' => $interior['submit'], 'variant' => 'dark', 'class' => 'form-submit', 'type' => 'submit', 'disabled' => true]); ?>
</form>
