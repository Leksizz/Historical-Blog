<?php

namespace App\Core\Container;

use App\Core\Config\Config;
use App\Core\Config\ConfigInterface;
use App\Core\DataBase\DataBase;
use App\Core\DataBase\DataBaseInterface;
use App\Core\Http\Redirect;
use App\Core\Http\RedirectInterface;
use App\Core\Http\Request;
use App\Core\Http\RequestInterface;
use App\Core\Router\Router;
use App\Core\Router\RouterInterface;
use App\Core\Session\Session;
use App\Core\Session\SessionInterface;
use App\Core\View\View;
use App\Core\View\ViewInterface;

class Container
{
    public readonly RequestInterface $request;
    public readonly RouterInterface $router;
    public readonly ViewInterface $view;
    public readonly RedirectInterface $redirect;
    public readonly SessionInterface $session;
    public readonly ConfigInterface $config;
    public readonly DataBaseInterface $dataBase;

    public function __construct()
    {
        $this->registerServices();
    }

    private function registerServices(): void
    {
        $this->request = Request::createFromGlobals();
        $this->view = new View();
        $this->redirect = new Redirect();
        $this->session = new Session();
        $this->config = new Config();
        $this->dataBase = new DataBase($this->config);
        $this->router = new Router($this->view, $this->request, $this->redirect, $this->session, $this->dataBase);
    }
}