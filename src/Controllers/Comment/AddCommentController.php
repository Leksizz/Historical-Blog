<?php

namespace App\Src\Controllers\Comment;

use App\Core\Controller\Controller;
use App\Core\DTO\DTOFactory;
use App\Core\Exceptions\DTOException;
use App\Core\Repository\RepositoryFactory;
use App\Src\Services\Comment\AddCommentService;
use JetBrains\PhpStorm\NoReturn;

class AddCommentController extends Controller
{
    /**
     * @throws DTOException
     */
    #[NoReturn] public function addComment(): void
    {
        $dto = DTOFactory::createFromRequest($this->request(), 'comment');
        $commentRepository = RepositoryFactory::getRepository('comment', $this->db());
        $service = new AddCommentService($dto, $commentRepository, $this->session(), $this->request(), $this->response(), $this->logger());
        $service->addComment();
    }
}