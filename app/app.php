<?php

define('ROOT_PATH', __DIR__ . '/../');
require __DIR__ . '/../vendor/autoload.php';
$envFile = ROOT_PATH . '.env';
if (file_exists($envFile)) {
    $dotenv = new Dotenv\Dotenv(ROOT_PATH);
    $dotenv->load();
}
$settings = require __DIR__ . '/../app/settings.php';
$app = new \Slim\App($settings);
require __DIR__ . '/../app/dependencies.php';
require __DIR__ . '/../app/middleware.php';
require __DIR__ . '/../app/services.php';
require __DIR__ . '/../app/routes.php';
