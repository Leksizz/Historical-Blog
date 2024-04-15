<?php

namespace App\Core\Controller;

use App\Core\DataBase\DataBaseInterface;
use App\Core\Http\RedirectInterface;
use App\Core\Http\RequestInterface;
use App\Core\Session\SessionInterface;
use App\Core\View\ViewInterface;

abstract class Controller
{
    private ViewInterface $view;
    private RequestInterface $request;
    private RedirectInterface $redirect;
    private SessionInterface $session;
    private DataBaseInterface $dataBase;


    public function view(string $path): void
    {
        $this->view->render($path);
    }

    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    public function request(): RequestInterface
    {
        return $this->request;
    }

    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    public function setRedirect(RedirectInterface $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function redirect(string $url): void
    {
        $this->redirect->to($url);
    }

    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }

    public function session(): SessionInterface
    {
        return $this->session;
    }

    public function setDataBase(DataBaseInterface $dataBase): void
    {
        $this->dataBase = $dataBase;
    }

    public function db(): DataBaseInterface
    {
        return $this->dataBase;
    }

//    public function __construct($route)
//    {
//        $this->route = $route;
//        $this->view = new View($this->route);
//    }
//
//
//    protected function loadModel($data = null)
//    {
//        $this->model = 'application\models\\' . $this->route['controller'] . '\\Model' . ucfirst($this->route['action']);
//        if (class_exists($this->model)) {
//            return new $this->model($data);
//        }
//    }
//
//    protected function isPost()
//    {
//        if (empty($_POST)) {
//            return false;
//        } else {
//            $this->model = $this->loadModel($_POST);
//            return true;
//        }
//    }
//
}
