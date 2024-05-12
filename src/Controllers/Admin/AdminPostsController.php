<?php

namespace App\Src\Controllers\Admin;

use App\Core\Controller\Controller;
use App\Core\Repository\RepositoryFactory;
use App\Src\Services\Admin\AdminPostsService;
use JetBrains\PhpStorm\NoReturn;

class AdminPostsController extends Controller
{
    public function index(): void
    {
        $this->view('/admin/posts', 'Статьи');
    }

    #[NoReturn] public function getPosts(): void
    {
        $this->service()->getPosts();
    }

    public function deletePost(): void
    {
        if ($this->service()->deletePost()) {
            $this->redirect('/admin/posts');
        }
    }

    private function service(): AdminPostsService
    {
        $repository = RepositoryFactory::getRepository('admin', $this->db());
        return new AdminPostsService($repository, $this->response(), $this->request(), $this->logger());
    }
}