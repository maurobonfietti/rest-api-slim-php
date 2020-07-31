<?php

declare(strict_types=1);

return [
    'settings' => [
        'displayErrorDetails' => $_SERVER['DISPLAY_ERROR_DETAILS'],
        'db' => [
            'hostname' => $_SERVER['DB_HOSTNAME'],
            'database' => $_SERVER['DB_DATABASE'],
            'username' => $_SERVER['DB_USERNAME'],
            'password' => $_SERVER['DB_PASSWORD'],
        ],
    ],
];
