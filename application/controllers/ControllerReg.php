<?php

namespace application\controllers;

use application\core\Controller;

class ControllerReg extends Controller
{
    public function actionReg()
    {
        if ($this->isPost()) {
//            $this->model = $this->loadModel($this->route['controller'], $_POST)->register();
//            exit($this->view->location('/'));
        }
        $this->view->render('Регистрация');
    }
}