<?php

declare(strict_types=1);

require __DIR__ . '/../../src/App/App.php';

try {
    $settings = $app->getContainer()->get('settings');
    $hostname = $settings['db']['hostname'];
    $username = $settings['db']['username'];
    $password = $settings['db']['password'];

    $pdo = new PDO("mysql:host=$hostname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DROP DATABASE IF EXISTS " . $settings['db']['database'] . " ; ";
    $pdo->exec($sql);
    echo "Database Droped successfully" . PHP_EOL;

    $sql = "CREATE DATABASE " . $settings['db']['database'] . " ; ";
    $pdo->exec($sql);
    echo "Database created successfully" . PHP_EOL;

    $sql = "USE " . $settings['db']['database'] . " ; ";
    $pdo->exec($sql);
    echo "Database used successfully" . PHP_EOL;

    $sql = file_get_contents(__DIR__ . '/../../database/database.sql');
    $pdo->exec($sql);
    echo "Database inserted successfully" . PHP_EOL;
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
