<?php

namespace App\Core\Router;

use App\Core\Http\Request;
use App\Core\View\View;

class Router
{


    public function __construct(
        private readonly View    $view,
        private readonly Request $request)
    {
        $this->initRoutes();
    }

    private
    array $routes = [
        'GET' => [],
        'POST' => []
    ];

    public
    function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if (!$route) {
            View::errorCode('404');
        }

        if (is_array($route->getAction())) {

            [$controller, $action] = $route->getAction();

            $controller = new $controller();

            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, $action]);
        } else {
            call_user_func($route->getAction());
        }
    }

    private
    function findRoute(string $uri, string $method): Route|false
    {
        if (!isset($this->routes[$method][$uri])) {
            return false;
        }
        return $this->routes[$method][$uri];
    }

    private
    function initRoutes(): void
    {
        $routes = $this->getRoutes();
        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    private
    function getRoutes(): array
    {
        return require_once APP_PATH . '/config/routes.php';
    }

}

