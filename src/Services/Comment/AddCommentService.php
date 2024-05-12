<?php

namespace App\Src\Services\Comment;

use App\Core\Http\Request\RequestInterface;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Logger\LoggerInterface;
use App\Core\Session\SessionInterface;
use App\Src\DTO\Comment\CommentDTO;
use App\Src\Models\Comment\Comment;
use App\Src\Repositories\Comment\CommentRepositoryInterface;
use JetBrains\PhpStorm\NoReturn;

class AddCommentService
{
    private Comment $comment;

    public function __construct(
        private readonly array|CommentDTO           $dto,
        private readonly CommentRepositoryInterface $commentRepository,
        private readonly SessionInterface           $session,
        private readonly RequestInterface           $request,
        private readonly ResponseInterface          $response,
        private readonly LoggerInterface            $logger,
    )
    {
        if (is_array($dto)) {
            $this->response->json(['status' => 'error', 'result' => $dto])->send();
        }

        $this->comment = new Comment($this->dto, $this->session, $this->request);
    }

    #[NoReturn] public function addComment(): void
    {
        $this->commentRepository->save($this->comment->get());
        $this->logger->write('Пользователь ' . $this->comment->author() . ' добавил комментарий к посту ' . $this->comment->page(), 'post/changes');
        $this->response->json(['href' => '/post/' . $this->comment->page()])->send();
    }
}