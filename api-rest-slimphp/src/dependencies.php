<?php

$container = $app->getContainer();

// PDO database library
$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    $pdo = new PDO('mysql:host='.$settings['host'].';dbname='.$settings['dbname'],
            $settings['user'], $settings['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo;
};
