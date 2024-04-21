<?php

namespace App\Сontrollers;

use App\Core\Controller\Controller;

class RegisterController extends Controller
{
    public function index(): void
    {
        $this->view('user/register');
    }

//    public function register(): void
//    {
//        $user = CreateUserDTOFactory::fromRequest($this->request());
//        $this->db()->insert('users', $user);
//        $json = $this->response()->json(["status" => "success"]);
//        $json->send();
//
//        $this->redirect('/');
//    }
}