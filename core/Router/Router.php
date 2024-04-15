<?php

namespace App\Core\Router;


use App\Core\DataBase\DataBaseInterface;
use App\Core\Http\RedirectInterface;
use App\Core\Http\RequestInterface;
use App\Core\Session\SessionInterface;
use App\Core\View\ViewInterface;

class Router implements RouterInterface
{


    public function __construct(
        private readonly ViewInterface     $view,
        private readonly RequestInterface  $request,
        private readonly RedirectInterface $redirect,
        private readonly SessionInterface  $session,
        private readonly DataBaseInterface $dataBase,
    )
    {
        $this->initRoutes();
    }

    private
    array $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if (!$route) {
            ViewInterface::errorCode('404');
        }

        if (is_array($route->getAction())) {

            [$controller, $action] = $route->getAction();

            $controller = new $controller();

            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);
            call_user_func([$controller, 'setDataBase'], $this->dataBase);
            call_user_func([$controller, $action]);
        } else {
            call_user_func($route->getAction());
        }
    }

    private function findRoute(string $uri, string $method): Route|false
    {
        if (!isset($this->routes[$method][$uri])) {
            return false;
        }
        return $this->routes[$method][$uri];
    }

    private function initRoutes(): void
    {
        $routes = $this->getRoutes();
        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    private function getRoutes(): array
    {
        return require_once APP_PATH . '/config/routes.php';
    }

}

