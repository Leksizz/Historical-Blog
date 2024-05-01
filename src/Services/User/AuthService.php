<?php

namespace App\Src\Services\User;

use App\Core\Auth\Auth;
use App\Core\DTO\User\UserDTO;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Repository\RepositoryInterface;
use App\Core\Session\SessionInterface;
use App\Src\Models\User\User;
use JetBrains\PhpStorm\NoReturn;

class AuthService
{
    private string $table;
    private User $user;


    public function __construct(
        private readonly RepositoryInterface $userRepository,
        private readonly UserDTO|array       $userDTO,
        private readonly ResponseInterface   $response,
        private readonly Auth                $auth,
        private readonly SessionInterface    $session,
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

    private function attempt(): bool
    {
        $user = $this->userRepository->getUserByEmail($this->table(), $this->user->email());

        if (!$user) {
            return false;
        }

        if (!password_verify($this->userDTO->password, $user['password'])) {
            return false;
        }

        $this->session->set($this->auth->sessionField(), $user);

        return true;
    }

    #[NoReturn] public function authentication(): void
    {
        if ($this->attempt()) {
            $this->response->json(['href' => '/'])->send();
        }

        $this->response->json(['status' => 'error', 'result' => 'Неверный логин или пароль'])->send();

    }
}
