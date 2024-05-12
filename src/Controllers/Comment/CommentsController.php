<?php

namespace App\Src\Controllers\Comment;

use App\Core\Controller\Controller;
use App\Core\Repository\RepositoryFactory;
use App\Src\Services\Comment\GetCommentsService;
use JetBrains\PhpStorm\NoReturn;

class CommentsController extends Controller
{
    #[NoReturn] public function getComments(): void
    {
        $commentRepository = RepositoryFactory::getRepository('comment', $this->db());
        $service = new GetCommentsService($commentRepository, $this->request(), $this->response());
        $service->getComments();
    }
}