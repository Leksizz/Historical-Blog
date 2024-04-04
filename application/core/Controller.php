<?php

namespace application\core;

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

    public function loadModel($data = null)
    {
        $this->model = 'application\models\\' . 'Model' . ucfirst($this->route['controller']);
        if (class_exists($this->model)) {
            return new $this->model($data);
        }
    }

    protected function isPost()
    {
        if (empty($_POST)) {
            return false;
        } else {
            return true;
        }
    }

}
