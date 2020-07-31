<?php

declare(strict_types=1);

require __DIR__ . '/../../src/App/App.php';

try {
    $hostname = is_string($_SERVER['DB_HOSTNAME']) ? $_SERVER['DB_HOSTNAME'] : null;
    $username = is_string($_SERVER['DB_USERNAME']) ? $_SERVER['DB_USERNAME'] : null;
    $password = is_string($_SERVER['DB_PASSWORD']) ? $_SERVER['DB_PASSWORD'] : null;
    $database = is_string($_SERVER['DB_DATABASE']) ? $_SERVER['DB_DATABASE'] : null;

    $pdo = new PDO("mysql:host=${hostname}", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("DROP DATABASE IF EXISTS ${database}");
    echo '[OK] Database droped successfully' . PHP_EOL;

    $pdo->exec("CREATE DATABASE ${database}");
    echo '[OK] Database created successfully' . PHP_EOL;

    $pdo->exec("USE ${database}");
    echo '[OK] Database selected successfully' . PHP_EOL;

    $sql = file_get_contents(__DIR__ . '/../../database/database.sql');
    $pdo->exec($sql);
    echo '[OK] Records inserted successfully' . PHP_EOL;
} catch (PDOException $exception) {
    echo '[ERROR] ' . $exception->getMessage() . PHP_EOL;
}
