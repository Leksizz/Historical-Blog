<?php

namespace App\Src\Controllers;

use App\Core\Controller\Controller;

class ProfileController extends Controller
{
    public function index(): void
    {
        $this->view('user/profile', 'Профиль');
    }

    public function file()
    {
        $file = $this->request()->file('avatar');
        dd($file->move('user'));
    }

}