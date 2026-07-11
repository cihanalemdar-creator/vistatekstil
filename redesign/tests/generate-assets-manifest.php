<?php
declare(strict_types=1);

$assets = require dirname(__DIR__) . '/data/assets.php';
$target = dirname(__DIR__) . '/data/assets-manifest.php';
$php = "<?php\ndeclare(strict_types=1);\n\nreturn " . var_export($assets, true) . ";\n";

if (file_put_contents($target, $php) === false) {
    throw new RuntimeException('Could not write asset manifest.');
}

echo sprintf("Generated %s with %d top-level groups.\n", $target, count($assets));
