<?php

namespace App\Src\Controllers;

use App\Core\Controller\Controller;
use App\Src\Services\Blog\SendSessionService\SendSessionService;

class MainController extends Controller
{
    public function index(): void
    {
        $this->view('main/index', 'Historium');

    }

    public function sendSession(): void
    {
        $service = new SendSessionService($this->session(), $this->response());
        $service->sendSession();
    }

    public function logout(): void
    {
        $this->auth()->logout();
        $this->redirect('/');
    }
}