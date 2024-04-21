<?php

namespace App\Сontrollers;

use App\Core\Controller\Controller;

class MainController extends Controller
{
    public function index(): void
    {
        $this->view('main/index');
    }
}