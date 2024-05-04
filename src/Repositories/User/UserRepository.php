<?php

namespace App\Src\Repositories\User;

use App\Core\Repository\Repository;

class UserRepository extends Repository
{
    public function getUserByEmail(string $table, string $email): ?array
    {
        return $this->get($table, ['email' => $email]);
    }

    public function getUserById(string $table, string $id): ?array
    {
        return $this->get($table, ['id' => $id]);
    }

    public function has(string $table, string $field, string $value): bool
    {
        if ($this->get($table, [$field => $value])) {
            return true;
        }
        return false;
    }
}