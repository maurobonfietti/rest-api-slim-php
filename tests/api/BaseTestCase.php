<?php

namespace Tests\api;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;

class BaseTestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Process the application given a request method and URI
     *
     * @param string $requestMethod the request method (e.g. GET, POST, etc.)
     * @param string $requestUri the request URI
     * @param array|object|null $requestData the request data
     * @return \Slim\Http\Response
     */
    public function runApp($requestMethod, $requestUri, $requestData = null)
    {
        // Create a mock environment for testing with
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );

        // Set up a request object based on the environment
        $request = Request::createFromEnvironment($environment);

        // Add request data, if it exists
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        // Load environment variables
        $baseDir = __DIR__ . '/../../';
        $envFile = $baseDir . '.env';
        if (file_exists($envFile)) {
            $dotenv = new \Dotenv\Dotenv($baseDir);
            $dotenv->load();
        }

        // Use the application settings
        $settings = require __DIR__ . '/../../app/settings.php';

        // Instantiate the application
        $app = new App($settings);

        // Set up dependencies
        require __DIR__ . '/../../app/dependencies.php';

        // Register middleware
        require __DIR__ . '/../../app/middleware.php';

        // Register services
        require __DIR__ . '/../../app/services.php';

        // Register routes
        require __DIR__ . '/../../app/routes.php';

        // Process the application
        $response = $app->process($request, new Response());

        // Return the response
        return $response;
    }
}
