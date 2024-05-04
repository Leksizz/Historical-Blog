<?php

namespace App\Src\Controllers\Blog;

use App\Core\Controller\Controller;

class MainController extends Controller
{
    public function index(): void
    {
        $this->view('main/index', 'Historium');
    }
}