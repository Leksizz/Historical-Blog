<?php

namespace App\Src\Services\User;

use App\Core\Http\Response\ResponseInterface;
use App\Core\Logger\LoggerInterface;
use App\Src\DTO\User\UserDTO;
use App\Src\Models\User\User;
use App\Src\Repositories\User\UserRepositoryInterface;
use JetBrains\PhpStorm\NoReturn;

class RegisterService
{
    private User $user;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserDTO|array           $dto,
        private readonly ResponseInterface       $response,
        private readonly LoggerInterface         $logger,
    )
    {
        if (is_array($dto)) {
            $this->response->json(['status' => 'error', 'result' => $dto])->send();
        }

        $this->user = new User($this->dto);
    }


    #[NoReturn] public function register(): void
    {
        $errors = [];
        if ($this->userRepository->has(
            ['email' => $this->user->email()],
        )) {
            $errors[] = ' Такой имейл уже занят ';
        }
        if ($this->userRepository->has(
            ['nickname' => $this->user->nickname()],
        )) {
            $errors[] = ' Такой никнейм уже занят ';
        }

        if (!empty($errors)) {
            $this->response->json(['status' => 'error', 'result' => $errors])->send();
        }

        $this->logger->write("Пользователь " . $this->user->nickname() . " успешно зарегистрирован", 'user/changes');

        $this->userRepository->save($this->user->get());
        $this->response->json(['href' => '/login'])->send();
    }
}