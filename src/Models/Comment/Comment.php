<?php

namespace App\Src\Models\Comment;

use App\Core\Http\Request\RequestInterface;
use App\Core\Session\SessionInterface;
use App\Src\DTO\Comment\CommentDTO;

class Comment
{
    private string $comment;
    private string $author;
    private int $page;
    private string $date;

    public function __construct(
        CommentDTO       $dto,
        SessionInterface $session,
        RequestInterface $request,
    )
    {
        $this->comment = $dto->comment;
        $this->author = $session->getColumn('user', 'nickname');
        $this->page = explode('/', $request->uri())[2];
        $this->date = date('Y-m-d H:i:s');
    }

    public function comment(): string
    {
        return $this->comment;
    }

    public function author(): string
    {
        return $this->author;
    }

    public function page(): int
    {
        return $this->page;
    }

    public function date(): string
    {
        return $this->date;
    }

    public function get(): array
    {
        return [
            'comment' => $this->comment(),
            'author' => $this->author(),
            'page' => $this->page(),
            'date' => $this->date(),
        ];
    }
}