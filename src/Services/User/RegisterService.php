<?php

namespace App\Src\Services\User;

use App\Core\DTO\User\UserDTO;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Repository\RepositoryInterface;
use App\Src\Models\User\User;
use App\Src\Services\User\traits\SetTable;
use JetBrains\PhpStorm\NoReturn;

class RegisterService
{
    private string $table;
    private User $user;

    public function __construct(
        private readonly RepositoryInterface $userRepository,
        private readonly UserDTO|array       $dto,
        private readonly ResponseInterface   $response
    )
    {
        if (is_array($dto)) {
            $this->response->json(['status' => 'error', 'result' => $dto])->send();
        }

        $this->user = new User($this->dto);
        $this->setTable();
    }

    use SetTable;

    #[NoReturn] public function register(): void
    {
        $errors = [];
        if ($this->userRepository->has([
            'table' => $this->table(),
            'where' => ['email' => $this->user->email()],
        ])) {
            $errors[] = ' Такой имейл уже занят ';
        }
        if ($this->userRepository->has([
            'table' => $this->table(),
            'where' => ['nickname' => $this->user->nickname()],
        ])) {
            $errors[] = ' Такой никнейм уже занят ';
        }

        if (!empty($errors)) {
            $this->response->json(['status' => 'error', 'result' => $errors])->send();
        }

        $this->userRepository->save([
            'table' => $this->table(),
            'data' => $this->user->get(),
        ]);
        $this->response->json(['href' => '/login'])->send();
    }
}