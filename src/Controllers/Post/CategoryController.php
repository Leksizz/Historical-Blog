<?php

namespace App\Src\Controllers\Post;

use App\Core\Controller\Controller;
use App\Core\Repository\RepositoryFactory;
use App\Src\Services\Post\GetPostService;
use JetBrains\PhpStorm\NoReturn;

class CategoryController extends Controller
{
    public function index(): void
    {
        $title = explode('/', $this->request()->uri())[1];
        $this->view('post/category', $title);
    }

    #[NoReturn] public function getPosts(): void
    {
        $post = RepositoryFactory::getRepository('post', $this->db());
        $service = new GetPostService($post, $this->response(), $this->request());
        $service->getPostsByCategory();
    }

}