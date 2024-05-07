<?php

namespace App\Core\Repository;

use App\Core\DataBase\DataBaseInterface;
use App\Src\Repositories\Admin\AdminRepository;
use App\Src\Repositories\Post\PostRepository;
use App\Src\Repositories\User\UserRepository;

class RepositoryFactory
{
    public static function getRepository(string $type, DataBaseInterface $db): RepositoryInterface
    {
        return match ($type) {
            'user' => new UserRepository($db),
            'post' => new PostRepository($db),
            'admin' => new AdminRepository($db),
        };
    }

}