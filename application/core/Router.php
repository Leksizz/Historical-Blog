<?php

namespace application\core;

class Router
{
    private $routes = [];
    private $params = [];

    public function __construct()
    {
        $routes = require_once 'application/config/routes.php';
        foreach ($routes as $route => $params) {
            $this->add($route, $params);
        }
    }

    private function add($route, $params)
    {
        $route = '#^' . $route . '$#';
        $this->routes[$route] = $params;
    }

    private function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function start()
    {
        if ($this->match()) {
            $controller = 'application\controllers\\' . 'Controller' . ucfirst($this->params['controller']);
            if (class_exists($controller)) {
                $action = 'action' . ucfirst($this->params['action']);
                if (method_exists($controller, $action)) {
                    $controller = new $controller($this->params);
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }
}

