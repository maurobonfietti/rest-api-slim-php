<?php declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';
$baseDir = __DIR__ . '/../../';
$envFile = $baseDir . '.env';
if (file_exists($envFile)) {
    $dotenv = new Dotenv\Dotenv($baseDir);
    $dotenv->load();
}
$settings = require __DIR__ . '/Settings.php';
$app = new \Slim\App($settings);
require __DIR__ . '/Dependencies.php';
require __DIR__ . '/Middleware.php';
require __DIR__ . '/Services.php';
require __DIR__ . '/Repositories.php';
require __DIR__ . '/Routes.php';
