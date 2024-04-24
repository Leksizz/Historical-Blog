<?php

namespace App\Src\Repositories;

use App\Core\Repository\Repository;

class UserRepository extends Repository
{
    public function getUserById(string $table, int $id): ?array
    {
        return $this->get($table, ['id' => $id]);
    }

    public function getUserByEmail(string $table, string $email): ?array
    {
        return $this->get($table, ['email' => $email]);
    }

    public function has(string $table, string $field, string $email): bool
    {
        if ($this->get($table, [$field => $email])) {
            return true;
        }
        return false;
    }


}