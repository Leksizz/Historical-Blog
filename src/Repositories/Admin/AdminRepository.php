<?php

namespace App\Src\Repositories\Admin;

use App\Core\Repository\Repository;

class AdminRepository extends Repository implements AdminRepositoryInterface
{

    public function allUsers(): ?array
    {
        return $this->get([
            'table' => $this->table(),
        ]);
    }

    public function editUser(array $set, int $id): bool
    {
        return $this->edit([
            'table' => $this->table(),
            'set' => $set,
            'where' => ['id' => $id],
        ]);
    }

    public function deleteUser(int $id): bool
    {
        return $this->delete([
            'table' => $this->table(),
            'where' => ['id' => $id],
        ]);
    }

    public function allPosts(): ?array
    {
        return $this->get([
            'table' => $this->postsTable()
        ]);
    }

    public function deletePost(int $id): bool
    {
        return $this->delete([
            'table' => $this->postsTable(),
            'where' => ['id' => $id],
        ]);
    }

    protected function table(): string
    {
        return 'users';
    }

    protected function postsTable(): string
    {
        return 'posts';
    }
}