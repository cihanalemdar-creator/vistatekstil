<?php

require __DIR__ . '/app/helpers.php';
require __DIR__ . '/app/contact.php';

set_error_handler(static function ($severity, $message, $file, $line) {
    if ((error_reporting() & $severity) === 0) {
        return false;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
});

$bufferLevel = ob_get_level();
ob_start();

function vista_clear_output_buffers($bufferLevel)
{
    while (ob_get_level() > $bufferLevel) {
        ob_end_clean();
    }
}

function vista_render_plain_error($exception, $bufferLevel)
{
    vista_clear_output_buffers($bufferLevel);
    error_log('[Vista redesign fallback] ' . $exception->getMessage());
    echo '<!doctype html><html lang="tr"><meta charset="utf-8"><title>Vista Moda Tekstil</title><body><main><h1>Sayfa şu anda görüntülenemiyor.</h1><p><a href="/">Ana sayfa</a></p></main></body></html>';
}

function vista_render_error($exception, $bufferLevel)
{
    vista_clear_output_buffers($bufferLevel);
    error_log(sprintf(
        '[Vista redesign] %s in %s:%d',
        $exception->getMessage(),
        $exception->getFile(),
        $exception->getLine()
    ));
    if (!headers_sent()) {
        http_response_code(500);
    }

    try {
        $context = require __DIR__ . '/app/error-context.php';
        extract($context, EXTR_SKIP);
        ob_start();
        require __DIR__ . '/layouts/site.php';
        ob_end_flush();
    } catch (Exception $fallbackException) {
        vista_render_plain_error($fallbackException, $bufferLevel);
    } catch (Error $fallbackException) {
        vista_render_plain_error($fallbackException, $bufferLevel);
    }
}

try {
    $context = require __DIR__ . '/app/bootstrap.php';
    extract($context, EXTR_SKIP);
    require __DIR__ . '/layouts/site.php';
    ob_end_flush();
} catch (Exception $exception) {
    vista_render_error($exception, $bufferLevel);
} catch (Error $exception) {
    vista_render_error($exception, $bufferLevel);
}
