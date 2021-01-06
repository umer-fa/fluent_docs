<?php
declare(strict_types=1);

require "../../autoload.php";

try {
    // AppKernel Bootstrapper
    $bootstrapper = (new \Comely\App\Bootstrapper(dirname(__FILE__, 4)))
        ->env("frontend")
        ->loadCachedConfig(true)
        ->dev(false);

    // Bootstrap
    $app = App::Bootstrap($bootstrapper);

    /**
     * HTTP Routing
     */
    $router = $app->http()->router();
    $router->route("/*", 'App\Controllers\Frontend\*')
        ->fallbackController('App\Controllers\Frontend\Home');

    /**
     * RESTful HTTP request
     */
    \Comely\Http\RESTful::Request($router, function (\Comely\Http\Router\AbstractController $controller) {
        $controller->router()->response()->send($controller);
    });
} catch (Exception $e) {
    /** @noinspection PhpUnhandledExceptionInspection */
    throw $e;
}