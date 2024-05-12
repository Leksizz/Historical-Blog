<?php

namespace App\Src\Services\User;

use App\Core\Http\Response\ResponseInterface;
use App\Core\Session\SessionInterface;
use App\Src\Repositories\User\UserRepositoryInterface;

use JetBrains\PhpStorm\NoReturn;

class GetUserService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly ResponseInterface       $response,
        private readonly SessionInterface        $session,
    )
    {
    }

    #[NoReturn] public function getUser(): void
    {
        $id = $this->session->get('user')['id'];
        $user = $this->userRepository->getUserById($id);
        $this->response->json(['status' => 'success', 'result' => $user])->send();
    }
}