<?php

return [
    'settings' => [
        'displayErrorDetails' => getenv('DISPLAY_ERROR_DETAILS'), // set to false in production
        'logger' => [
            'enabled' => filter_var(getenv('LOGGER_ENABLED'), FILTER_VALIDATE_BOOLEAN),
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::INFO,
        ],
        'db' => [
            'hostname' => getenv('DB_HOSTNAME'),
            'database' => getenv('DB_DATABASE'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
        ],
    ],
];
