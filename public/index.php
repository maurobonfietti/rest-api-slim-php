<?php

declare(strict_types=1);

// Silence PHP 8.6 deprecations raised inside vendor/slim (Slim 3 uses is_integer()),
// since their output breaks Slim's response. All other errors are left as they are.
set_error_handler(static function (int $severity, string $message, string $file): bool {
    $isSlimDeprecation = $severity === E_DEPRECATED
        && str_contains($file, DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'slim' . DIRECTORY_SEPARATOR);

    return $isSlimDeprecation;
});

require __DIR__ . '/../src/App/App.php';

$app->run();
