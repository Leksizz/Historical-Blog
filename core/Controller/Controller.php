<?php

namespace App\Core\Controller;

use App\Core\View\View;

abstract class Controller
{
    private View $view;

    public function view(string $path): void
    {
        $this->view->render($path);
    }

    public function setView(View $view): void
    {
        $this->view = $view;
    }


//    public function __construct($route)
//    {
//        $this->route = $route;
//        $this->view = new View($this->route);
//    }
//
//
//    protected function loadModel($data = null)
//    {
//        $this->model = 'application\models\\' . $this->route['controller'] . '\\Model' . ucfirst($this->route['action']);
//        if (class_exists($this->model)) {
//            return new $this->model($data);
//        }
//    }
//
//    protected function isPost()
//    {
//        if (empty($_POST)) {
//            return false;
//        } else {
//            $this->model = $this->loadModel($_POST);
//            return true;
//        }
//    }
//
}
