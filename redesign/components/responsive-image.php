<?php
$thumbnail = isset($asset['thumbnail']) ? $asset['thumbnail'] : null;
$source = asset_url($asset);
$src = $thumbnail ? asset_url((string) $thumbnail) : $source;
$loading = isset($loading) ? $loading : 'lazy';
$sizes = isset($sizes) ? $sizes : '(max-width: 680px) 100vw, (max-width: 1100px) 50vw, 33vw';
?>
<img<?= !empty($class) ? ' class="' . e($class) . '"' : '' ?> src="<?= e($src) ?>"<?= $thumbnail ? ' srcset="' . e($src) . ' 520w, ' . e($source) . ' 900w" sizes="' . e($sizes) . '"' : '' ?> alt="<?= e(asset_alt($asset, $locale)) ?>" loading="<?= e($loading) ?>" decoding="async">
