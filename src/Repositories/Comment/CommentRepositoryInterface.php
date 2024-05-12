<?php

namespace App\Src\Repositories\Comment;

interface CommentRepositoryInterface
{
    public function save(array $data): false|int;

    public function getComments(int $page): ?array;
}