<?php

namespace Core;

abstract class Controller
{
    public $model;
    public $view;

    public function __construct($route)
    {
        $this->view = new View($route);
    }
}
