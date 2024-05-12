<?php

namespace App\Src\Services\Post;

use App\Core\Http\Request\RequestInterface;
use App\Core\Http\Response\ResponseInterface;
use App\Src\Repositories\Post\PostRepositoryInterface;
use JetBrains\PhpStorm\NoReturn;

class GetPostService
{
    public function __construct(
        private readonly PostRepositoryInterface $postRepository,
        private readonly ResponseInterface       $response,
        private readonly RequestInterface        $request,
    )
    {

    }

    #[NoReturn] public function getPost(): void
    {
        $post = $this->postRepository->getPostById($this->id(2));
        $this->updateViews();
        $this->response->json(['status' => 'success', 'result' => $post])->send();
    }


    #[NoReturn] public function getPostsByCategory(): void
    {
        $limit = 5;
        $offset = ($this->id(3) - 1) * $limit;
        $post = $this->postRepository->getPostsByCategory($this->category(), $limit, $offset);
        $post['total'] = $this->postRepository->getNumberOfPostsByCategory($this->category());
        $this->response->json(['status' => 'success', 'result' => $post])->send();
    }

    #[NoReturn] public function getPopularPosts(): void
    {
        $limit = 5;
        $posts = $this->postRepository->getPopularPosts($limit);
        $this->response->json(['status' => 'success', 'result' => $posts])->send();
    }

    private function updateViews(): void
    {
        $views = $this->postRepository->getViews($this->id(2));

        $this->postRepository->increaseViews($views, $this->id(2));
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