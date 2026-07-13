<?php

$assets = require dirname(__DIR__) . '/data/assets.php';
$target = dirname(__DIR__) . '/data/assets-manifest.php';
$export = var_export($assets, true);
$normalizedExport = preg_replace('/[ \t]+$/m', '', $export);
$export = $normalizedExport === null ? $export : $normalizedExport;
$php = "<?php\n\nreturn " . $export . ";\n";

if (file_put_contents($target, $php) === false) {
    throw new RuntimeException('Could not write asset manifest.');
}

echo sprintf("Generated %s with %d top-level groups.\n", $target, count($assets));
