<?php

declare(strict_types=1);

require __DIR__ . '/../../src/App/App.php';

try {
    $settings = $app->getContainer()->get('settings');

    $hostname = $settings['db']['hostname'];
    $username = $settings['db']['username'];
    $password = $settings['db']['password'];
    $database = $settings['db']['database'];

    $pdo = new PDO("mysql:host=$hostname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DROP DATABASE IF EXISTS $database";
    $pdo->exec($sql);
    echo "[OK] Database droped successfully" . PHP_EOL;

    $sql = "CREATE DATABASE $database";
    $pdo->exec($sql);
    echo "[OK] Database created successfully" . PHP_EOL;

    $sql = "USE $database";
    $pdo->exec($sql);
    echo "[OK] Database selected successfully" . PHP_EOL;

    $sql = file_get_contents(__DIR__ . '/../../database/database.sql');
    $pdo->exec($sql);
    echo "[OK] Records inserted successfully" . PHP_EOL;
} catch (PDOException $e) {
    echo "[ERROR] " . $e->getMessage() . PHP_EOL;
}
