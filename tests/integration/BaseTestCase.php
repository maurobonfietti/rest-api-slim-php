<?php

declare(strict_types=1);

namespace Tests\integration;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use Psr\Http\Message\ResponseInterface;

class BaseTestCase extends \PHPUnit\Framework\TestCase
{
    public static string $jwt = '';

    public function runApp(
        string $requestMethod,
        string $requestUri,
        array $requestData = null
    ): ResponseInterface {
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );

        $request = Request::createFromEnvironment($environment);
        $request = $request->withHeader('Authorization', self::$jwt);

        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        $baseDir = __DIR__ . '/../../';
        $dotenv = \Dotenv\Dotenv::createUnsafeImmutable($baseDir);
        $envFile = $baseDir . '.env';
        if (file_exists($envFile)) {
            $dotenv->load();
        }

        $settings = require __DIR__ . '/../../src/App/Settings.php';

        $app = new App($settings);

        $container = $app->getContainer();

        require __DIR__ . '/../../src/App/Dependencies.php';
        require __DIR__ . '/../../src/App/Services.php';
        require __DIR__ . '/../../src/App/Repositories.php';
        require __DIR__ . '/../../src/App/Routes.php';
        (require __DIR__ . '/../../src/App/Routes.php')($app);

        return $app->process($request, new Response());
    }
}
