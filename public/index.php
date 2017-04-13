<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Register class base
require __DIR__.'/../src/Controller/Base.php';

// Register class tasks controller
require __DIR__.'/../src/Controller/TasksController.php';

// Register class users controller
require __DIR__.'/../src/Controller/UsersController.php';

// Register class tasks repository
require __DIR__.'/../src/Repository/TasksRepository.php';

// Register class users repository
require __DIR__.'/../src/Repository/UsersRepository.php';

// Register class tasks service
require __DIR__.'/../src/Service/TasksService.php';

// Register class users service
require __DIR__.'/../src/Service/UsersService.php';

// Run app
$app->run();
