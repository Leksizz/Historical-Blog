<?php

namespace App\controllers;

use App\Core\Controller\Controller;

class RegisterController extends Controller
{
    public function index(): void
    {
        $this->view('user/register');
        exit($this->response()->json(['message' => 'success'], 200)->getContent());
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