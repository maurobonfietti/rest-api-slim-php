<?php declare(strict_types=1);

return [
    'settings' => [
        'displayErrorDetails' => getenv('DISPLAY_ERROR_DETAILS'),
        'db' => [
            'hostname' => getenv('DB_HOSTNAME'),
            'database' => getenv('DB_DATABASE'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
        ],
    ],
];
