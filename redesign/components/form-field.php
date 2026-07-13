<?php
$field = $contract['fields'][$name];
$label = $labels[$name];
$required = isset($field['required']) ? (bool) $field['required'] : false;
$type = (string) $field['type'];
$fullWidth = in_array($type, ['textarea', 'file'], true);
$errorId = $name . '-error';
$fieldValue = isset($value) ? (string) $value : '';
$error = isset($error) && is_string($error) && $error !== '' ? $error : null;
$describedBy = $required || $error !== null ? $errorId : null;
?>
<div class="form-field<?= $fullWidth ? ' form-field--full' : '' ?><?= $error !== null ? ' has-error' : '' ?>">
    <label for="<?= e($name) ?>"><?= e($label) ?><?= $required ? ' *' : '' ?></label>
    <?php if ($type === 'select'): ?>
        <select id="<?= e($name) ?>" name="<?= e($name) ?>"<?= $required ? ' required' : '' ?><?= $describedBy !== null ? ' aria-describedby="' . e($describedBy) . '"' : '' ?><?= $error !== null ? ' aria-invalid="true"' : '' ?>>
            <option value=""><?= e($labels['choose']) ?></option>
            <?php foreach ($field['options'] as $optionValue => $option): ?>
                <?php $optionLabel = isset($option['labelKey']) ? $labels[$option['labelKey']] : $option[$locale]; ?>
                <option value="<?= e($optionValue) ?>"<?= (string) $optionValue === $fieldValue ? ' selected' : '' ?>><?= e($optionLabel) ?></option>
            <?php endforeach; ?>
        </select>
    <?php elseif ($type === 'textarea'): ?>
        <textarea id="<?= e($name) ?>" name="<?= e($name) ?>" rows="<?= e(isset($field['rows']) ? $field['rows'] : 6) ?>"<?= $required ? ' required' : '' ?><?= $describedBy !== null ? ' aria-describedby="' . e($describedBy) . '"' : '' ?><?= $error !== null ? ' aria-invalid="true"' : '' ?>><?= e($fieldValue) ?></textarea>
    <?php else: ?>
        <input id="<?= e($name) ?>" name="<?= e($name) ?>" type="<?= e($type) ?>"<?= $type !== 'file' ? ' value="' . e($fieldValue) . '"' : '' ?><?= isset($field['min']) ? ' min="' . e($field['min']) . '"' : '' ?><?= isset($field['accept']) ? ' accept="' . e($field['accept']) . '"' : '' ?><?= isset($field['autocomplete']) ? ' autocomplete="' . e($field['autocomplete']) . '"' : '' ?><?= isset($field['inputmode']) ? ' inputmode="' . e($field['inputmode']) . '"' : '' ?><?= $required ? ' required' : '' ?><?= $describedBy !== null ? ' aria-describedby="' . e($describedBy) . '"' : '' ?><?= $error !== null ? ' aria-invalid="true"' : '' ?>>
    <?php endif; ?>
    <?php if ($required || $error !== null): ?><small class="field-error<?= $error !== null ? ' is-visible' : '' ?>" id="<?= e($errorId) ?>"><?= e($error !== null ? $error : $labels['required']) ?></small><?php endif; ?>
    <?php if (isset($field['help'])): ?><small><?= e(is_array($field['help']) ? (isset($field['help'][$locale]) ? $field['help'][$locale] : $field['help']['en']) : $field['help']) ?></small><?php endif; ?>
</div>
