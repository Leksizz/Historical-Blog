<?php

namespace App\Src\Repositories\User;

use App\Core\Repository\Repository;

class UserRepository extends Repository implements UserRepositoryInterface
{
    public function getUserByEmail(string $email): ?array
    {
        return $this->one([
            'table' => $this->table(),
            'where' => ['email' => $email],
        ]);
    }

    public function deleteAvatar(string $defaultAvatar, int $id): bool
    {
        return $this->edit([
            'table' => $this->table(),
            'set' => ['avatar' => $defaultAvatar],
            'where' => ['id' => $id],
        ]);
    }

    public function updateAvatar(string $avatar, int $id): bool
    {
        return $this->edit([
            'table' => $this->table(),
            'set' => ['avatar' => $avatar],
            'where' => ['id' => $id],
        ]);
    }

    public function getUserById(int $id): ?array
    {
        return $this->one([
            'table' => $this->table(),
            'where' => ['id' => $id],
        ]);
    }

    public function has(array $where): bool
    {
        if ($this->one([
            'table' => $this->table(),
            'where' => $where,
        ])) {
            return true;
        }
        return false;
    }

    public function save(array $data): false|int
    {
        return $this->add([
            'table' => $this->table(),
            'data' => $data,
        ]);
    }

    protected function table(): string
    {
        return 'users';
    }
}