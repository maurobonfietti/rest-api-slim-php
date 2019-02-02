<?php

return [
    'settings' => [
        'displayErrorDetails' => getenv('DISPLAY_ERROR_DETAILS'), // set to false in production
        'db' => [
            'hostname' => getenv('DB_HOSTNAME'),
            'database' => getenv('DB_DATABASE'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
        ],
        'useRedisCache' => filter_var(getenv('USE_REDIS_CACHE'), FILTER_VALIDATE_BOOLEAN),
    ],
];
