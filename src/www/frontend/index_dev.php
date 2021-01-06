<?php
declare(strict_types=1);

require "../../autoload.php";

try {
    // AppKernel Bootstrapper
    $bootstrapper = (new \Comely\App\Bootstrapper(dirname(__FILE__, 4)))
        ->env("frontend_dev")
        ->loadCachedConfig(false)// Load cached config
        ->dev(true); // DEVELOPMENT MODE ON

    // Bootstrap
    $app = App::Bootstrap($bootstrapper);

    // Authentication
    $auth = new \Comely\Http\Router\Authentication\BasicAuth('Development mode');
    $auth->user("admin", "password");

    /**
     * HTTP Routing
     */
    $router = $app->http()->router();
    $router->route("/*", 'App\Controllers\Frontend\*')
        ->auth($auth)
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