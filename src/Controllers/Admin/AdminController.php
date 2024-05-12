<?php

namespace App\Src\Controllers\Admin;

use App\Core\Controller\Controller;

class AdminController extends Controller
{
    public function index(): void
    {
        $this->view('admin/admin', 'Администратор');
    }
}