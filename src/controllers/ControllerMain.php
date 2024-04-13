<?php

namespace App\controllers;

use App\Core\Controller\Controller;

class ControllerMain extends Controller
{
    public function index(): void
    {
        $this->view('index');
//        $this->view->render('Historium');
    }
}