<?php

namespace App\Src\Controllers\Post;

use App\Core\Controller\Controller;
use App\Core\DTO\DTOFactory;
use App\Core\Exceptions\DTOException;
use App\Core\Repository\RepositoryFactory;
use App\Src\Services\Post\addPostService;

class AddPostController extends Controller
{
    public function index(): void
    {
        $this->view('post/addPost', 'Добавить статью');
    }

    /**
     * @throws DTOException
     */
    public function addPost(): void
    {
        $dto = DTOFactory::createFromRequest($this->request(), 'post');
        $post = RepositoryFactory::getRepository('post', $this->db());
        $service = new AddPostService($dto, $post, $this->response(), $this->session());
        $service->addPost();
    }

}