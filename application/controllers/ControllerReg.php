<?php

namespace controllers;

use Core\Controller;
use models\ModelReg;

class ControllerReg extends Controller
{
    public function actionIndex()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model = new ModelReg($_POST);
            $this->model->register();
        }
        $this->view->generate('reg.html');
    }
}