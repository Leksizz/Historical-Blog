<?php

namespace App\Src\Services\Admin;

use App\Core\Http\Request\RequestInterface;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Logger\LoggerInterface;
use App\Src\Repositories\Admin\AdminRepositoryInterface;
use JetBrains\PhpStorm\NoReturn;

class AdminPostsService
{

    public function __construct(
        private readonly AdminRepositoryInterface $adminRepository,
        private readonly ResponseInterface        $response,
        private readonly RequestInterface         $request,
        private readonly LoggerInterface          $logger,
    )
    {
    }

    #[NoReturn] public function getPosts(): void
    {
        $posts = $this->adminRepository->allPosts();
        $this->response->json(['status' => 'success', 'result' => $posts])->send();
    }

    public function deletePost(): bool
    {
        if ($this->adminRepository->deletePost($this->id())) {
            $this->logger->write("Пост " . $this->id() . " удалён", 'admin/changes');
            return true;
        }
        return false;
    }

    private function id(): int
    {
        return explode('/', $this->request->uri())[4];
    }
}