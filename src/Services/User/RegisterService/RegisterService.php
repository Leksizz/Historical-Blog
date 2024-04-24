<?php

namespace App\Src\Services\User\RegisterService;

use App\Core\DTO\User\UserDTO;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Repository\RepositoryInterface;
use App\Src\Models\User;
use JetBrains\PhpStorm\NoReturn;

class RegisterService
{
    private string $table;
    private User $user;

    public function __construct(
        private readonly RepositoryInterface $userRepository,
        private readonly UserDTO|array       $userDTO,
        private readonly ResponseInterface   $response
    )
    {
        if (is_array($userDTO)) {
            $this->response->json(['status' => 'error', 'result' => $userDTO])->send();
        }

        $this->user = new User($this->userDTO);
        $this->setTable();
    }

    private function setTable(): void
    {
        $this->table = 'users';
    }

    private function table(): string
    {
        return $this->table;
    }

    #[NoReturn] public function register(): void
    {
        $errors = [];

        if ($this->userRepository->has($this->table(), 'email', $this->user->email())) {
            $errors[] = ' Такой имейл уже занят ';
        }
        if ($this->userRepository->has($this->table(), 'nickname', $this->user->nickname())) {
            $errors[] = ' Такой никнейм уже занят ';
        }

        if (!empty($errors)) {
            $this->response->json(['status' => 'error', 'result' => $errors])->send();
        }

        $this->userRepository->save($this->table(), $this->user->get());
        $this->response->json(['href' => '/login'])->send();
    }
}