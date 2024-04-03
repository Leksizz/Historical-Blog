<?php

namespace application\controllers;

use application\core\Controller;

class ControllerMain extends Controller
{
    public function actionIndex()
    {
        $this->view->render('Historium');
    }
}