<?php

namespace App\Src\Controllers;

use App\Core\Controller\Controller;

class AddPostController extends Controller
{
    public function index(): void
    {
        $this->view('post/addPost', 'Добавить статью');
    }

    public function addPost()
    {
//        $this->response()->json(['status' => 'success', 'result' => $_POST])->send();
        dd($_POST['content']);
    }

}