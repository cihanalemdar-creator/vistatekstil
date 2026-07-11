<?php
$field = $contract['fields'][$name];
$label = $labels[$name];
$required = (bool) ($field['required'] ?? false);
$type = (string) $field['type'];
$fullWidth = in_array($type, ['textarea', 'file'], true);
$errorId = $name . '-error';
?>
<div class="form-field<?= $fullWidth ? ' form-field--full' : '' ?>">
    <label for="<?= e($name) ?>"><?= e($label) ?><?= $required ? ' *' : '' ?></label>
    <?php if ($type === 'select'): ?>
        <select id="<?= e($name) ?>" name="<?= e($name) ?>"<?= $required ? ' required aria-describedby="' . e($errorId) . '"' : '' ?>>
            <option value=""><?= e($labels['choose']) ?></option>
            <?php foreach ($field['options'] as $value => $option): ?>
                <?php $optionLabel = isset($option['labelKey']) ? $labels[$option['labelKey']] : $option[$locale]; ?>
                <option value="<?= e($value) ?>"><?= e($optionLabel) ?></option>
            <?php endforeach; ?>
        </select>
    <?php elseif ($type === 'textarea'): ?>
        <textarea id="<?= e($name) ?>" name="<?= e($name) ?>" rows="<?= e($field['rows'] ?? 6) ?>"<?= $required ? ' required aria-describedby="' . e($errorId) . '"' : '' ?>></textarea>
    <?php else: ?>
        <input id="<?= e($name) ?>" name="<?= e($name) ?>" type="<?= e($type) ?>"<?= isset($field['min']) ? ' min="' . e($field['min']) . '"' : '' ?><?= isset($field['accept']) ? ' accept="' . e($field['accept']) . '"' : '' ?><?= isset($field['autocomplete']) ? ' autocomplete="' . e($field['autocomplete']) . '"' : '' ?><?= isset($field['inputmode']) ? ' inputmode="' . e($field['inputmode']) . '"' : '' ?><?= $required ? ' required aria-describedby="' . e($errorId) . '"' : '' ?>>
    <?php endif; ?>
    <?php if ($required): ?><small class="field-error" id="<?= e($errorId) ?>"><?= e($labels['required']) ?></small><?php endif; ?>
    <?php if (isset($field['help'])): ?><small><?= e($field['help']) ?></small><?php endif; ?>
</div>
