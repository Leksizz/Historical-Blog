<?php

namespace App\Src\Controllers;

use App\Core\Controller\Controller;
use App\Core\DTO\DTOFactory;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->view('user/login', 'Авторизация');
    }

    public function login()
    {

    }

}