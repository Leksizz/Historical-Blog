<?php

namespace App\core;

abstract class Controller
{
    public $route;
    public $model;
    public $view;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($this->route);
    }


    protected function loadModel($data = null)
    {
        $this->model = 'application\models\\' . $this->route['controller'] . '\\Model' . ucfirst($this->route['action']);
        if (class_exists($this->model)) {
            return new $this->model($data);
        }
    }

    protected function isPost()
    {
        if (empty($_POST)) {
            return false;
        } else {
            $this->model = $this->loadModel($_POST);
            return true;
        }
    }

}
