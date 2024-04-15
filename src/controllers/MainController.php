<?php

namespace App\controllers;

use App\Core\Controller\Controller;
use App\Core\Http\Redirect;
use App\Core\Validator\Validator;

class MainController extends Controller
{
    public function index(): void
    {
        $this->view('main/index');
    }
}