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
//            'host' => '127.0.0.1',
            'host' => 'mysql',
            'dbname' => 'api_rest_slimphp',
            'user' => 'app',
            'pass' => 'password',
        ],
    ],
];
