<?php

namespace App\Src\Services\Admin;

use App\Core\Http\Response\ResponseInterface;
use App\Core\Repository\RepositoryInterface;
use App\Core\Session\SessionInterface;
use JetBrains\PhpStorm\NoReturn;

class AdminService
{
    public function __construct(
        private readonly RepositoryInterface $adminRepository,
        private readonly ResponseInterface   $response,
        private readonly SessionInterface    $session,
    )
    {
    }

    #[NoReturn] public function getUsers(): void
    {
        $users = $this->adminRepository->get([
            'table' => 'users',
        ]);
        $this->response->json(['status' => 'success', 'result' => $users])->send();
    }
}