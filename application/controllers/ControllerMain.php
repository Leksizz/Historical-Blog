<?php

namespace controllers;

use Core\Controller;

class ControllerMain extends Controller
{
    public function actionIndex()
    {
        $this->view->render('Historium');
    }
}