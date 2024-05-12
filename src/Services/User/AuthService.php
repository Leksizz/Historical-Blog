<?php

namespace App\Src\Services\User;

use App\Core\Auth\AuthInterface;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Logger\LoggerInterface;
use App\Core\Session\SessionInterface;
use App\Src\DTO\User\UserDTO;
use App\Src\Models\User\User;
use App\Src\Repositories\User\UserRepositoryInterface;
use JetBrains\PhpStorm\NoReturn;

class AuthService
{
    private User $user;


    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserDTO|array           $dto,
        private readonly ResponseInterface       $response,
        private readonly AuthInterface           $auth,
        private readonly SessionInterface        $session,
        private readonly LoggerInterface         $logger,
    )
    {
        if (is_array($dto)) {
            $this->response->json(['status' => 'error', 'result' => $dto])->send();
        }

        $this->user = new User($this->dto);
    }


    private function attempt(): bool
    {
        $user = $this->userRepository->getUserByEmail($this->user->email());

        if (!$user) {
            return false;
        }

        if (!password_verify($this->dto->password, $user['password'])) {
            return false;
        }

        $this->session->set($this->auth->sessionField(), $user);

        return true;
    }

    #[NoReturn] public function authentication(): void
    {
        if ($this->attempt()) {
            $this->logger->write("Пользователь " . $this->session->getColumn('user', 'id') . " зашёл на сайт", 'user/changes');
            $this->response->json(['href' => '/'])->send();
        }

        $this->response->json(['status' => 'error', 'result' => 'Неверный логин или пароль'])->send();

    }
}
