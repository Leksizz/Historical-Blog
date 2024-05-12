<?php

namespace App\Src\Repositories\Post;

interface PostRepositoryInterface
{
    public function save(array $data): false|int;

    public function getPostById(int $id): ?array;

    public function getPostsByCategory(string $category, int $limit, int $offset): ?array;

    public function getNumberOfPostsByCategory(string $category): int;

    public function getPopularPosts(int $limit): ?array;

    public function getViews(int $id): int;

    public function increaseViews(int $views, int $id): bool;

}