<?php

namespace App\Src\Repositories\User;

use App\Core\Repository\Repository;

class UserRepository extends Repository
{
    public function getUserByEmail(array $params): ?array
    {
        return $this->one($params);
    }

    public function has(array $params): bool
    {
        if ($this->one($params)) {
            return true;
        }
        return false;
    }
}