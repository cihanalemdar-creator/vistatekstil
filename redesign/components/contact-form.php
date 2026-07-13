<?php
$labels = $contract['labels'][$locale];
$state = isset($formState) && is_array($formState) ? $formState : ['enabled' => false, 'csrf' => '', 'status' => null, 'message' => null, 'errors' => [], 'values' => [], 'privacy' => false];
$detailErrors = array_intersect(array_keys($state['errors']), $contract['groups']['details']);
?>
<form class="quote-form" action="<?= e($actionPath) ?>#quote-form" method="post" enctype="multipart/form-data" data-quote-form data-form-enabled="<?= $state['enabled'] ? 'true' : 'false' ?>" data-fixed-control-avoid>
    <input type="hidden" name="_csrf" value="<?= e($state['csrf']) ?>">
    <div class="form-honeypot" aria-hidden="true"><label for="website">Website</label><input id="website" name="website" type="text" tabindex="-1" autocomplete="off"></div>
    <div class="quote-form__basic">
        <?php foreach ($contract['groups']['basic'] as $fieldName): ?>
            <?php render_component('form-field', ['name' => $fieldName, 'contract' => $contract, 'labels' => $labels, 'locale' => $locale, 'value' => isset($state['values'][$fieldName]) ? $state['values'][$fieldName] : '', 'error' => isset($state['errors'][$fieldName]) ? $state['errors'][$fieldName] : null]); ?>
        <?php endforeach; ?>
    </div>

    <details class="form-details" data-form-details<?= $detailErrors !== [] ? ' open' : '' ?>>
        <summary><span><?= e($labels['details']) ?></span><small><?= e($labels['detailsHint']) ?></small></summary>
        <div class="form-details__grid">
            <?php foreach ($contract['groups']['details'] as $fieldName): ?>
                <?php render_component('form-field', ['name' => $fieldName, 'contract' => $contract, 'labels' => $labels, 'locale' => $locale, 'value' => isset($state['values'][$fieldName]) ? $state['values'][$fieldName] : '', 'error' => isset($state['errors'][$fieldName]) ? $state['errors'][$fieldName] : null]); ?>
            <?php endforeach; ?>
        </div>
    </details>

    <label class="privacy-field<?= isset($state['errors']['privacy']) ? ' has-error' : '' ?>"><input type="checkbox" name="privacy" value="1" required<?= $state['privacy'] ? ' checked' : '' ?>><span><?= e($interior['privacy']) ?> *</span></label>
    <?php if (isset($state['errors']['privacy'])): ?><small class="field-error is-visible privacy-error"><?= e($state['errors']['privacy']) ?></small><?php endif; ?>
    <div class="form-status form-status--success" aria-live="polite"<?= $state['status'] === 'success' ? '' : ' hidden' ?>><?= $state['status'] === 'success' ? e($state['message']) : '' ?></div>
    <div class="form-status form-status--error" aria-live="assertive"<?= $state['status'] === 'error' ? '' : ' hidden' ?>><?= $state['status'] === 'error' ? e($state['message']) : '' ?></div>
    <?php render_component('button', ['label' => $interior['submit'], 'variant' => 'dark', 'class' => 'form-submit', 'type' => 'submit', 'disabled' => !$state['enabled']]); ?>
</form>
