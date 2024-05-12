<?php

namespace App\Src\Repositories\Comment;

use App\Core\Repository\Repository;

class CommentRepository extends Repository implements CommentRepositoryInterface
{

    public function save(array $data): false|int
    {
        return $this->add([
            'table' => $this->table(),
            'data' => $data,
        ]);
    }

    public function getComments(int $page): ?array
    {
        return $this->get([
            'table' => $this->table(),
            'where' => ['page' => $page],
        ]);
    }

    protected function table(): string
    {
        return 'comments';
    }
}