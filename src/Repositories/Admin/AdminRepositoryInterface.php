<?php

namespace App\Src\Repositories\Admin;

interface AdminRepositoryInterface
{
    public function allUsers(): ?array;

    public function editUser(array $set, int $id): bool;

    public function deleteUser(int $id): bool;

    public function allPosts(): ?array;

    public function deletePost(int $id): bool;

}