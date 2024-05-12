<?php

namespace App\Src\Services\Admin;

use App\Core\Http\Request\RequestInterface;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Logger\LoggerInterface;
use App\Src\DTO\User\UserDTO;
use App\Src\Models\User\User;
use App\Src\Repositories\Admin\AdminRepositoryInterface;
use JetBrains\PhpStorm\NoReturn;

class AdminUsersService
{

    private User $user;

    public function __construct(
        private readonly AdminRepositoryInterface $adminRepository,
        private readonly ResponseInterface        $response,
        private readonly UserDTO|array            $dto,
        private readonly RequestInterface         $request,
        private readonly LoggerInterface          $logger,
    )
    {
        if (is_array($dto)) {
            $this->response->json(['status' => 'error', 'result' => $dto])->send();
        }

        $this->user = new User($this->dto);
    }

    #[NoReturn] public function getUsers(): void
    {
        $users = $this->adminRepository->allUsers();
        $this->response->json(['status' => 'success', 'result' => $users])->send();
    }

    public function editUser(): void
    {
        if ($this->adminRepository->editUser(
            [
                'name' => $this->user->name(),
                'lastname' => $this->user->lastname(),
                'nickname' => $this->user->nickname(),
                'email' => $this->user->email(),
            ], $this->id())) {
            $this->logger->write("Пользователь " . $this->id() . " отредактирован", 'admin/changes');
            $this->response->json(['status' => 'success', 'href' => '/admin/users'])->send();
        }
    }

    public function deleteUser(): bool
    {
        if ($this->adminRepository->deleteUser($this->id())) {
            $this->logger->write("Пользователь " . $this->id() . " удалён", 'admin/changes');
            return true;
        }
        return false;
    }

    private function id(): int
    {
        return explode('/', $this->request->uri())[4];
    }

}