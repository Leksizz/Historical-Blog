<?php

namespace App\Core\Controller;

use App\Core\Auth\AuthInterface;
use App\Core\DataBase\DataBaseInterface;
use App\Core\Http\Redirect\RedirectInterface;
use App\Core\Http\Request\RequestInterface;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Session\SessionInterface;
use App\Core\View\ViewInterface;

abstract class Controller
{
    private ViewInterface $view;
    private RequestInterface $request;
    private RedirectInterface $redirect;
    private SessionInterface $session;
    private DataBaseInterface $dataBase;
    private AuthInterface $auth;
    private ResponseInterface $response;

    public function view(string $path, string $title): void
    {
        $this->view->render($path, $title);
    }

    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    public function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }

    public function response(): ResponseInterface
    {
        return $this->response;
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

    public function setAuth(AuthInterface $auth): void
    {
         $this->auth = $auth;
    }

    public function auth(): AuthInterface
    {
        return $this->auth;
    }

}
