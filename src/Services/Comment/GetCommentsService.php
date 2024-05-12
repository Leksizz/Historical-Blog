<?php

namespace App\Src\Services\Comment;

use App\Core\Http\Request\RequestInterface;
use App\Core\Http\Response\ResponseInterface;
use App\Src\Repositories\Comment\CommentRepositoryInterface;
use JetBrains\PhpStorm\NoReturn;

class GetCommentsService
{
    public function __construct(
        private readonly CommentRepositoryInterface $commentRepository,
        private readonly RequestInterface           $request,
        private readonly ResponseInterface          $response,
    )
    {
    }

    #[NoReturn] public function getComments(): void
    {
        $comments = $this->commentRepository->getComments($this->page());
        $this->response->json(['status' => 'success', 'result' => $comments])->send();
    }

    public function page(): int
    {
        return explode('/', $this->request->uri())[2];
    }
}