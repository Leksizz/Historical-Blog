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
        // подумать над подключением модели + сделать вывод ошибок на фронте
        if ($this->isPost()) {
            $this->model = $this->loadModel($_POST);
            if ($this->model->register()) {
                $this->view->message('success', 'Регистрация прошла успешно');
//                $this->view->location('/');
            } else {
                $this->view->message('error', 'Такой пользователь уже существует');
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