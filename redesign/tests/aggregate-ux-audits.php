<?php
declare(strict_types=1);

$root = dirname(__DIR__);
$directory = $root . '/docs/qa/ux-revision';
$widths = [320, 375, 430, 768, 1024, 1280, 1440];
$sources = [];
$checks = [];
$failures = [];

foreach ($widths as $width) {
    $path = $directory . '/audit-' . $width . '.json';
    if (!is_file($path)) {
        throw new RuntimeException('Missing viewport audit: ' . $path);
    }
    $report = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
    $sources[] = basename($path);
    $checks = array_merge($checks, $report['checks'] ?? []);
    $failures = array_merge($failures, $report['failures'] ?? []);
}

$auxiliaryPath = $directory . '/audit-auxiliary.json';
$auxiliary = json_decode((string) file_get_contents($auxiliaryPath), true, 512, JSON_THROW_ON_ERROR);
$sources[] = basename($auxiliaryPath);
$checks = array_merge($checks, $auxiliary['checks'] ?? []);
$failures = array_merge($failures, $auxiliary['failures'] ?? []);

$combined = [
    'generatedAt' => gmdate(DATE_ATOM),
    'baseUrl' => 'http://127.0.0.1:8082',
    'coverage' => [
        'viewports' => $widths,
        'turkishRoutes' => ['/', '/kurumsal', '/urunler', '/tasarim', '/koleksiyon/referans', '/galeri/galerim2', '/iletisim'],
        'englishParityViewports' => [375, 1440],
        'englishRoutes' => ['/en/', '/en/about', '/en/products', '/en/design', '/en/collection', '/en/gallery', '/en/contact'],
        'auxiliary' => ['200-percent-text', 'long-CTA-labels', 'no-JavaScript', 'reduced-motion', 'WebKit-mobile'],
    ],
    'browsers' => ['Chromium/Chrome', 'WebKit'],
    'sources' => $sources,
    'checkCount' => count($checks),
    'passed' => count(array_filter($checks, static fn(array $check): bool => !empty($check['pass']))),
    'failed' => count($failures),
    'failures' => $failures,
    'checks' => $checks,
];

file_put_contents(
    $directory . '/audit.json',
    json_encode($combined, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR) . PHP_EOL
);

echo json_encode([
    'sources' => $combined['sources'],
    'checkCount' => $combined['checkCount'],
    'passed' => $combined['passed'],
    'failed' => $combined['failed'],
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), PHP_EOL;
