<?php

namespace App\controllers;

use App\Core\Controller\Controller;

class ControllerUser extends Controller
{

    public $message;


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
        if ($this->isPost()) {
            if ($this->model->login()) {
                $this->view->message('success', $this->model->message);
                $this->view->location('/profile');
            } else {
                exit($this->view->message('error', $this->model->message));
            }
        }
        $this->view->render('Авторизация');
    }

    public function actionProfile()
    {
        $this->loadModel();
        $_SESSION = $this->model->getSession();
        $this->view->render($_SESSION['login'], $_SESSION);
        // разобраться с выводом сессии на фронте
    }
}