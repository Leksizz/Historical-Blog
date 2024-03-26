<?php

namespace controllers;

use Core\Controller;
use models\ModelReg;

class ControllerReg extends Controller
{
    public function actionIndex()
    {
        $this->view->generate('reg.html');
    }

    public function actionReg()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model = new ModelReg($_POST);
            $this->model->register();
        }
    }
}