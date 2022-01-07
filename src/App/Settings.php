<?php

declare(strict_types=1);

return [
    'settings' => [
        'displayErrorDetails' => filter_var($_SERVER['DISPLAY_ERROR_DETAILS'], FILTER_VALIDATE_BOOLEAN),
        'db' => [
            'host' => $_SERVER['DB_HOST'],
            'name' => $_SERVER['DB_NAME'],
            'user' => $_SERVER['DB_USER'],
            'pass' => $_SERVER['DB_PASS'],
            'port' => $_SERVER['DB_PORT'],
        ],
        'redis' => [
            'enabled' => $_SERVER['REDIS_ENABLED'],
            'url' => $_SERVER['REDIS_URL'],
        ],
        'app' => [
            'domain' => $_SERVER['APP_DOMAIN'] ?? '',
            'secret' => $_SERVER['SECRET_KEY'],
        ],
    ],
];
