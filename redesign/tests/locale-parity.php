<?php
declare(strict_types=1);

require dirname(__DIR__) . '/app/helpers.php';

$content = require dirname(__DIR__) . '/data/content.php';
$form = require dirname(__DIR__) . '/data/form.php';
$site = require dirname(__DIR__) . '/data/site.php';
$routes = require dirname(__DIR__) . '/config/routes.php';
$reference = 'en';
$failures = [];

$assertSameKeys = static function (array $expected, array $actual, string $label) use (&$failures): void {
    $expectedKeys = array_keys($expected);
    $actualKeys = array_keys($actual);
    sort($expectedKeys);
    sort($actualKeys);
    if ($expectedKeys !== $actualKeys) {
        $failures[] = $label . ' keys differ';
    }
};

foreach (['de', 'es'] as $locale) {
    $assertSameKeys($content['pages']['home'][$reference], $content['pages']['home'][$locale], $locale . ' home');
    $assertSameKeys($content['interiors'][$reference], $content['interiors'][$locale], $locale . ' interiors');
    $assertSameKeys($form['labels'][$reference], $form['labels'][$locale], $locale . ' form labels');

    foreach (['about', 'products', 'design'] as $pageKey) {
        $expectedSections = count($content['interiors'][$reference][$pageKey]['sections']);
        $actualSections = count($content['interiors'][$locale][$pageKey]['sections']);
        if ($expectedSections !== $actualSections) {
            $failures[] = sprintf('%s %s sections: expected %d, got %d', $locale, $pageKey, $expectedSections, $actualSections);
        }
    }

    if (count($content['interiors'][$reference]['gallery']['filters']) !== count($content['interiors'][$locale]['gallery']['filters'])) {
        $failures[] = $locale . ' gallery filters differ';
    }

    foreach ($routes['pages'] as $pageKey => $page) {
        if (($page['locales'][$locale]['publicationStatus'] ?? 'unavailable') === 'unavailable') {
            $failures[] = $locale . ' route remains unavailable: ' . $pageKey;
        }
    }

    if (!isset($site['contact']['hours'][$locale])) {
        $failures[] = $locale . ' working hours missing';
    }
    foreach ($site['facts'] as $index => $fact) {
        if (!isset($fact['label'][$locale], $fact['shortLabel'][$locale])) {
            $failures[] = sprintf('%s fact %d translation missing', $locale, $index);
        }
    }
}

if ($failures !== []) {
    fwrite(STDERR, implode(PHP_EOL, $failures) . PHP_EOL);
    exit(1);
}

echo json_encode([
    'status' => 'PASS',
    'locales' => ['de', 'es'],
    'routesPerLocale' => count($routes['pages']),
    'aboutSections' => count($content['interiors'][$reference]['about']['sections']),
    'productSections' => count($content['interiors'][$reference]['products']['sections']),
    'designSections' => count($content['interiors'][$reference]['design']['sections']),
    'galleryFilters' => count($content['interiors'][$reference]['gallery']['filters']),
    'formFields' => count($form['fields']),
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;
