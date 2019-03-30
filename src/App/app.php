<?php

require __DIR__ . '/../../vendor/autoload.php';
$baseDir = __DIR__ . '/../../';
$envFile = $baseDir . '.env';
if (file_exists($envFile)) {
    $dotenv = new Dotenv\Dotenv($baseDir);
    $dotenv->load();
}
$settings = require __DIR__ . '/settings.php';
$app = new \Slim\App($settings);
require __DIR__ . '/dependencies.php';
require __DIR__ . '/middleware.php';
require __DIR__ . '/services.php';
require __DIR__ . '/routes.php';
