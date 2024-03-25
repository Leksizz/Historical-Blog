<?php

namespace controllers;

use Core\Controller;

class ControllerMain extends Controller
{
    function actionIndex()
    {
        $this->view->generate('main.html');
    }
}