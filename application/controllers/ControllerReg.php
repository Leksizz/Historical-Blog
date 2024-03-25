<?php

namespace controllers;

use Core\Controller;
use Core\View;
use models\ModelReg;

class ControllerReg extends Controller
{
    function __construct()
    {
        $this->model = new ModelReg($_POST);
        $this->view = new View();
    }

    function actionIndex()
    {
//        $data = $this->model->;
//        $this->view->generate('reg.html', $data);
    }
}