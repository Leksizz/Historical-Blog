<?php

namespace App\Core\Container;

use App\Core\Auth\Auth;
use App\Core\Auth\AuthInterface;
use App\Core\Config\Config;
use App\Core\Config\ConfigInterface;
use App\Core\DataBase\DataBase;
use App\Core\DataBase\DataBaseInterface;
use App\Core\Http\Redirect\Redirect;
use App\Core\Http\Redirect\RedirectInterface;
use App\Core\Http\Request\Request;
use App\Core\Http\Request\RequestInterface;
use App\Core\Http\Response\Response;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Router\Router;
use App\Core\Router\RouterInterface;
use App\Core\Session\Session;
use App\Core\Session\SessionInterface;
use App\Core\Storage\Storage;
use App\Core\Storage\StorageInterface;
use App\Core\Validator\Validator;
use App\Core\Validator\ValidatorInterface;
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
    public readonly ValidatorInterface $validator;
    public readonly ResponseInterface $response;
    public readonly AuthInterface $auth;
    public readonly StorageInterface $storage;

    public function __construct()
    {
        $this->registerServices();
    }

    private function registerServices(): void
    {
        $this->validator = new Validator();
        $this->request = Request::createFromGlobals();
        $this->request->setValidator($this->validator);
        $this->view = new View();
        $this->redirect = new Redirect();
        $this->session = new Session();
        $this->config = new Config();
        $this->dataBase = new DataBase($this->config);
        $this->response = new Response();
        $this->auth = new Auth($this->dataBase, $this->session, $this->config);
        $this->storage = new Storage($this->config);
        $this->router = new Router($this->view, $this->request, $this->redirect, $this->response, $this->session, $this->dataBase, $this->auth, $this->storage);
    }
}