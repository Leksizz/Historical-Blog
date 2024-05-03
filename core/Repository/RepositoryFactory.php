<?php

namespace App\Core\Repository;

use App\Core\DataBase\DataBaseInterface;
use App\Src\Repositories\BlogRepository;
use App\Src\Repositories\UserRepository;

class RepositoryFactory
{
    public static function getRepository(string $type, DataBaseInterface $db): UserRepository|BlogRepository
    {
        return match ($type) {
            'user' => new UserRepository($db),
            'post' => new BlogRepository($db),
        };
    }

}