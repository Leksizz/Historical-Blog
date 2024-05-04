<?php

namespace App\Src\Controllers\Post;

use App\Core\Controller\Controller;

class PostController extends Controller
{
    public function index(): void
    {
        $this->view('post/post', 'Статья');
    }
}