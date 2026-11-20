<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php81\Rector\Property\ReadOnlyPropertyRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withPhpSets(php86: true)
    ->withSkip([
        // Entities are hydrated by PDO::fetchObject(), which writes $id from outside the constructor.
        ReadOnlyPropertyRector::class => [__DIR__ . '/src/Entity'],
    ]);
