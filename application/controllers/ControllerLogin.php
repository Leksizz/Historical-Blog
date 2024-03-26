<?php

namespace controllers;

use Core\Controller;

class ControllerLogin extends Controller
{
    public function actionIndex()
    {
        $this->view->generate('login.html');
    }
}