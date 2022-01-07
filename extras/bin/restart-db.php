<?php

declare(strict_types=1);

require __DIR__ . '/../../src/App/App.php';

try {
    $db = $container->get('settings')['db'];
    $host = $db['host'];
    $name = $db['name'];
    $user = $db['user'];
    $pass = $db['pass'];
    $port = $db['port'];

    $pdo = new PDO("mysql:host=${host};port=${port};charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("DROP DATABASE IF EXISTS ${name}");
    echo '[OK] Database droped successfully' . PHP_EOL;

    $pdo->exec("CREATE DATABASE ${name}");
    echo '[OK] Database created successfully' . PHP_EOL;

    $pdo->exec("USE ${name}");
    echo '[OK] Database selected successfully' . PHP_EOL;

    $sql = file_get_contents(__DIR__ . '/../../database/database.sql');
    $pdo->exec($sql);
    echo '[OK] Records inserted successfully' . PHP_EOL;
} catch (PDOException $exception) {
    echo '[ERROR] ' . $exception->getMessage() . PHP_EOL;
}
