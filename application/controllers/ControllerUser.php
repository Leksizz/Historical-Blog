<?php

namespace application\controllers;

use application\core\Controller;

class ControllerUser extends Controller
{

    public $message;


    public function actionIndex()
    {

    }

    public function actionRegister()
    {
        if ($this->isPost()) {
            if ($this->model->register()) {
                $this->view->message('success', $this->model->message);
                $this->view->location('/login');
            } else {
                exit($this->view->message('error', $this->model->message));
            }
        }
        $this->view->render('Регистрация');
    }

    public function actionLogin()
    {
        $this->view->render('Авторизация');
    }

    public function actionProfile()
    {
    }
}