<?php

namespace App\controllers;

use App\Core\Controller\Controller;
use App\Core\DTO\User\CreateUserDTOFactory;

class RegisterController extends Controller
{
    public function index(): void
    {
        $this->view('user/register');
    }

    public function register()
    {
        $dto = CreateUserDTOFactory::fromRequest($this->request());
        $r = $this->response()->json(["status" => "success", "result" => $dto], 200); // Доделать json метод, чтобы корректно возвращалсь $data и на фронте робило + проверить работу валидатора
        var_dump($r);
    }

//    public function register()
//    {
//        $validation = $this->request()->validate([
//            'name' => 'name',
//            'lastname' => 'lastname',
//            'login' => 'login',
//            'email' => 'email',
//            'password' => 'password'
//        ]);

//        if (!$validation) {
//            $this->request()->
//        }

//    }
}