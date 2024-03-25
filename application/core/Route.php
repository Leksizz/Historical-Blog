<?php

namespace Core;
class Route
{
    public static function start()
    {
        $controllerName = 'Main';
        $actionName = 'Index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $controllerName = $routes[1];
        }

        if (!empty($routes[2])) {
            $actionName = $routes[2];
        }

        $modelName = 'Model' . $controllerName;
        $controllerFile = 'Controller' . $controllerName . '.php';
        $controllerPath = "application/controllers/" . $controllerFile;
        $controllerName = 'controllers\\' . 'Controller' . $controllerName;
        $actionName = 'action' . $actionName;

        $modelFile = $modelName . '.php';
        $modelPath = "application/models/" . $modelFile;
        if (file_exists($modelPath)) {
            require_once "$modelPath";
        }


        if (file_exists($controllerPath)) {
        require_once "$controllerPath";
        } else {
            Route::ErrorPage404(); // Переписать позже под исключение
        }

        $controller = new $controllerName;
        $action = $actionName;


        if (method_exists($controller, $action)) {
        $controller->$action();
        } else {
            Route::errorPage404(); // Переписать позже под исключение
        }
    }

    private static function errorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        header('Location:' . $host . '404');
    }

}


