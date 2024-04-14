<?php

namespace App\controllers;

use App\Core\Controller\Controller;
use App\Core\Validator\Validator;

class ControllerMain extends Controller
{
    public function index(): void
    {
        $this->view('main/index');
    }
}