<?php

namespace App\Src\Repositories\Post;

use App\Core\Repository\Repository;

class PostRepository extends Repository implements PostRepositoryInterface
{

    public function save(array $data): false|int
    {
        return $this->add([
            'table' => $this->table(),
            'data' => $data,
        ]);
    }

    public function getPostById(int $id): ?array
    {
        return $this->one([
            'table' => $this->table(),
            'where' => ['id' => $id],
        ]);
    }

    public function getPostsByCategory(string $category, int $limit, int $offset): ?array
    {
        return $this->get([
            'table' => $this->table(),
            'where' => ['category' => $category],
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    public function getNumberOfPostsByCategory(string $category): int
    {
        return $this->countColumn([
            'table' => $this->table(),
            'where' => ['category' => $category],
        ]);
    }

    public function getPopularPosts(int $limit): ?array
    {
        return $this->get([
            'table' => $this->table(),
            'limit' => $limit,
            'orderBy' => 'views',
            'orderCondition' => 'DESC',
        ]);
    }

    public function getViews(int $id): int
    {
        return $this->one([
            'table' => $this->table(),
            'columns' => ['views'],
            'where' => ['id' => $id],
        ])['views'];
    }

    public function increaseViews(int $views, int $id): bool
    {
        return $this->edit([
            'table' => $this->table(),
            'set' => ['views' => ++$views],
            'where' => ['id' => $id],
        ]);
    }

    protected function table(): string
    {
        return 'posts';
    }
}