<?php

require __DIR__ . '/../vendor/autoload.php';
$baseDir = __DIR__ . '/../';
$envFile = $baseDir . '.env';
if (file_exists($envFile)) {
    $dotenv = new Dotenv\Dotenv($baseDir);
    $dotenv->load();
}
$settings = require __DIR__ . '/../app/settings.php';
$app = new \Slim\App($settings);
require __DIR__ . '/../app/dependencies.php';
require __DIR__ . '/../app/middleware.php';
require __DIR__ . '/../app/services.php';
require __DIR__ . '/../app/routes.php';
