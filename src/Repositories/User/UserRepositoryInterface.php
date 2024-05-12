<?php

namespace App\Src\Repositories\User;

interface UserRepositoryInterface
{
    public function getUserByEmail(string $email): ?array;

    public function getUserById(int $id): ?array;

    public function has(array $where): bool;

    public function deleteAvatar(string $defaultAvatar, int $id): bool;

    public function updateAvatar(string $avatar, int $id): bool;

    public function save(array $data): false|int;
}