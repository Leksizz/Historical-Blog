<?php

namespace App\Core\Repository;

use App\Core\DataBase\DataBaseInterface;
use App\Src\Repositories\Admin\AdminRepository;
use App\Src\Repositories\Admin\AdminRepositoryInterface;
use App\Src\Repositories\Comment\CommentRepository;
use App\Src\Repositories\Comment\CommentRepositoryInterface;
use App\Src\Repositories\Post\PostRepository;
use App\Src\Repositories\Post\PostRepositoryInterface;
use App\Src\Repositories\User\UserRepository;
use App\Src\Repositories\User\UserRepositoryInterface;

class RepositoryFactory
{
    public static function getRepository(string $type, DataBaseInterface $db): UserRepositoryInterface|PostRepositoryInterface|AdminRepositoryInterface|CommentRepositoryInterface
    {
        return match ($type) {
            'user' => new UserRepository($db),
            'post' => new PostRepository($db),
            'admin' => new AdminRepository($db),
            'comment' => new CommentRepository($db),
        };
    }

}