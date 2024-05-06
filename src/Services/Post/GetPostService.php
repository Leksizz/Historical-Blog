<?php

namespace App\Src\Services\Post;

use App\Core\Http\Request\RequestInterface;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Repository\RepositoryInterface;
use App\Src\Services\Post\traits\SetTable;
use JetBrains\PhpStorm\NoReturn;

class GetPostService
{
    public function __construct(
        private readonly RepositoryInterface $postRepository,
        private readonly ResponseInterface   $response,
        private readonly RequestInterface    $request,
    )
    {
        $this->setTable();
    }

    use SetTable;

    #[NoReturn] public function getPost(): void
    {
        $post = $this->postRepository->getById([
            'table' => 'posts',
            'where' => ['id' => $this->id(2)],
        ]);
        $this->updateViews();
        $this->response->json(['status' => 'success', 'result' => $post])->send();
    }


    #[NoReturn] public function getPostsByCategory(): void
    {
        $limit = 5;
        $offset = ($this->id(3) - 1) * $limit;
        $post = $this->postRepository->get([
            'table' => $this->table(),
            'where' => ['category' => $this->category()],
            'limit' => $limit,
            'offset' => $offset,
        ]);
        $post['total'] = $this->postRepository->countColumn([
            'table' => $this->table(),
            'where' => ['category' => $this->category()],
        ]);
        $this->response->json(['status' => 'success', 'result' => $post])->send();
    }

    private function updateViews(): void
    {
        $views = $this->postRepository->one([
            'table' => $this->table(),
            'columns' => ['views'],
            'where' => ['id' => $this->id(2)],
        ])['views'];

        $this->postRepository->edit([
            'table' => $this->table(),
            'set' => ['views' => ++$views],
            'where' => ['id' => $this->id(2)]
        ]);
    }

    private function id(int $num): int
    {
        return explode('/', $this->request->uri())[$num];
    }

    private function category(): string
    {
        return explode('/', $this->request->uri())[2];
    }
}