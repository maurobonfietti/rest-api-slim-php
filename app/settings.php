<?php

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production

        // Logger settings
        'logger' => [
            'enabled' => true,
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::INFO,
        ],

        // Database connection settings
        'db' => [
            'host'   => getenv('DB_HOSTNAME'),
            'dbname' => getenv('DB_DATABASE'),
            'user'   => getenv('DB_USERNAME'),
            'pass'   => getenv('DB_PASSWORD'),
        ],
    ],
];
