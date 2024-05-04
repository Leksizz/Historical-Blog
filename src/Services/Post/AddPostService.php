<?php

namespace App\Src\Services\Post;

use App\Core\DTO\Post\PostDTO;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Repository\RepositoryInterface;
use App\Core\Session\SessionInterface;
use App\Src\Models\Post\Post;
use App\Src\Services\Post\traits\SetTable;
use JetBrains\PhpStorm\NoReturn;

class AddPostService
{
    private string $table;
    private Post $post;

    public function __construct(
        private readonly array|PostDTO       $dto,
        private readonly RepositoryInterface $postRepository,
        private readonly ResponseInterface   $response,
        private readonly SessionInterface    $session,
    )
    {
        if (is_array($dto)) {
            $this->response->json(['status' => 'error', 'result' => $dto])->send();
        }

        $this->setTable();
        $this->post = new Post($this->dto, $this->session);
    }

    use SetTable;

    #[NoReturn] public function addPost(): void
    {
        $this->postRepository->save($this->table(), $this->post->get());
        $this->response->json(['href' => '/'])->send();
    }

}