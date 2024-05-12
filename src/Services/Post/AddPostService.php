<?php

namespace App\Src\Services\Post;

use App\Core\Http\Response\ResponseInterface;
use App\Core\Logger\LoggerInterface;
use App\Core\Session\SessionInterface;
use App\Src\DTO\Post\PostDTO;
use App\Src\Models\Post\Post;
use App\Src\Repositories\Post\PostRepositoryInterface;
use JetBrains\PhpStorm\NoReturn;

class AddPostService
{
    private Post $post;

    public function __construct(
        private readonly array|PostDTO           $dto,
        private readonly PostRepositoryInterface $postRepository,
        private readonly ResponseInterface       $response,
        private readonly SessionInterface        $session,
        private readonly LoggerInterface         $logger,
    )
    {
        if (is_array($dto)) {
            $this->response->json(['status' => 'error', 'result' => $dto])->send();
        }

        $this->post = new Post($this->dto, $this->session);
    }


    #[NoReturn] public function addPost(): void
    {
        $this->postRepository->save($this->post->get());
        $this->logger->write($this->post->author() . " добавил пост " . $this->post->title(), "post/changes");
        $this->response->json(['href' => '/'])->send();
    }

}