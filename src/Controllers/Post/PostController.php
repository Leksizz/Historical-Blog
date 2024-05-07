<?php

namespace App\Src\Controllers\Post;

use App\Core\Controller\Controller;
use App\Core\Repository\RepositoryFactory;
use App\Src\Services\Post\GetPostService;
use JetBrains\PhpStorm\NoReturn;

class PostController extends Controller
{
    public function index(): void
    {
        $this->view('post/post', 'Статья');
    }

    #[NoReturn] public function getPost(): void
    {
        $this->getPostService()->getPost();
    }

    public function getPopularPosts(): void
    {
        $this->getPostService()->getPopularPosts();
    }

    private function getPostService(): GetPostService
    {
        $post = RepositoryFactory::getRepository('post', $this->db());
        return new GetPostService($post, $this->response(), $this->request());
    }
}