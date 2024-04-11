<?php

namespace App\controllers;

use App\core\Controller;

class ControllerMain extends Controller
{
    public function actionIndex(): void
    {
        $this->view->render('Historium');
    }
}