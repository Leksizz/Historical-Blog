<?php

namespace App\Core\Router;


use App\Core\Auth\AuthInterface;
use App\Core\DataBase\DataBaseInterface;
use App\Core\Http\Redirect\RedirectInterface;
use App\Core\Http\Request\RequestInterface;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Logger\LoggerInterface;
use App\Core\Session\SessionInterface;
use App\Core\Storage\StorageInterface;
use App\Core\View\View;
use App\Core\View\ViewInterface;
use JetBrains\PhpStorm\NoReturn;

class Router implements RouterInterface
{


    public function __construct(
        private readonly ViewInterface     $view,
        private readonly RequestInterface  $request,
        private readonly RedirectInterface $redirect,
        private readonly ResponseInterface $response,
        private readonly SessionInterface  $session,
        private readonly DataBaseInterface $dataBase,
        private readonly AuthInterface     $auth,
        private readonly StorageInterface  $storage,
        private readonly LoggerInterface   $logger,
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
            $this->notFound();
        }

        if ($route->hasMiddlewares()) {
            foreach ($route->getMiddlewares() as $middleware) {
                $middleware = new $middleware($this->request, $this->auth, $this->redirect);
                $middleware->handle();
            }
        }

        if (is_array($route->getAction())) {

            [$controller, $action] = $route->getAction();

            $controller = new $controller();

            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setResponse'], $this->response);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);
            call_user_func([$controller, 'setAuth'], $this->auth);
            call_user_func([$controller, 'setDataBase'], $this->dataBase);
            call_user_func([$controller, 'setStorage'], $this->storage);
            call_user_func([$controller, 'setLogger'], $this->logger);
            call_user_func([$controller, $action]);
        } else {
            call_user_func($route->getAction());
        }
    }

    private function findRoute(string $uri, string $method): Route|false
    {
        foreach ($this->routes[$method] as $pattern => $route) {
            if (preg_match("#^$pattern$#", $uri)) {
                return $route;
            }
        }
        return false;
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

    #[NoReturn] private function notFound(): void
    {
        View::errorCode('404');
    }

}

