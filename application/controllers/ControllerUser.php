<?php

namespace application\controllers;

use application\core\Controller;

class ControllerUser extends Controller
{

    public function __construct($route)
    {
        parent::__construct($route);

    }

    public function actionIndex()
    {

    }

    public function actionRegister()
    {
        if ($this->isPost()) {
            if ($this->model->register()) {
                $this->view->message('success', 'Регистрация прошла успешно');
                $this->view->location('/login');
            } else {
                exit($this->view->message('error', 'Такой пользователь уже существует'));
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