<?php

namespace App\Kernel\Router;

use App\core\View;

class Router
{

    public function __construct()
    {
        $this->initRoutes();
    }

    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function dispatch(string $uri, string $method)
    {
        $route = $this->findRoute($uri, $method);

        if (!$route) {
            View::errorCode('404');
        }

        if (is_array($route->getAction())) {

            [$controller, $action] = $route->getAction();

            $controller = new $controller();

            call_user_func([$controller, $action]);
        }
    }

    private function findRoute(string $uri, string $method): Route|false
    {
        if (!isset($this->routes[$method][$uri])) {
            return false;
        }
        return $this->routes[$method][$uri];
    }

    private function initRoutes()
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }

    }

    /**
     * @return Route[]
     */

    private function getRoutes(): array
    {
        return require_once APP_PATH . '/config/routes.php';
    }

}

