<?php
$variant = isset($variant) ? $variant : 'primary';
$extraClass = trim(isset($class) ? (string) $class : '');
$classes = trim('button button--' . $variant . ($extraClass !== '' ? ' ' . $extraClass : ''));
$icon = isset($icon) ? $icon : null;
$iconPosition = isset($iconPosition) ? $iconPosition : 'end';
$disabled = isset($disabled) ? (bool) $disabled : false;
?>
<?php if (isset($href)): ?>
<a class="<?= e($classes) ?>" href="<?= e(safe_href((string) $href)) ?>"<?= isset($ariaLabel) ? ' aria-label="' . e($ariaLabel) . '"' : '' ?>>
    <?php if ($icon !== null && $iconPosition === 'start'): ?><span class="button__icon" aria-hidden="true"><?= e($icon) ?></span><?php endif; ?>
    <span class="button__label"><?= e($label) ?></span>
    <?php if ($icon !== null && $iconPosition !== 'start'): ?><span class="button__icon" aria-hidden="true"><?= e($icon) ?></span><?php endif; ?>
</a>
<?php else: ?>
<button class="<?= e($classes) ?>" type="<?= e(isset($type) ? $type : 'button') ?>"<?= $disabled ? ' disabled aria-disabled="true"' : '' ?><?= isset($ariaLabel) ? ' aria-label="' . e($ariaLabel) . '"' : '' ?>>
    <?php if ($icon !== null && $iconPosition === 'start'): ?><span class="button__icon" aria-hidden="true"><?= e($icon) ?></span><?php endif; ?>
    <span class="button__label"><?= e($label) ?></span>
    <?php if ($icon !== null && $iconPosition !== 'start'): ?><span class="button__icon" aria-hidden="true"><?= e($icon) ?></span><?php endif; ?>
</button>
<?php endif; ?>
