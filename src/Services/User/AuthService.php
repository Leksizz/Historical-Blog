<?php

namespace App\Src\Services\User;

use App\Core\Auth\Auth;
use App\Core\DTO\User\UserDTO;
use App\Core\Http\Response\ResponseInterface;
use App\Core\Repository\RepositoryInterface;
use App\Core\Session\SessionInterface;
use App\Src\Models\User\User;
use App\Src\Services\User\traits\SetTable;
use JetBrains\PhpStorm\NoReturn;

class AuthService
{
    private User $user;


    public function __construct(
        private readonly RepositoryInterface $userRepository,
        private readonly UserDTO|array       $dto,
        private readonly ResponseInterface   $response,
        private readonly Auth                $auth,
        private readonly SessionInterface    $session,
    )
    {
        if (is_array($dto)) {
            $this->response->json(['status' => 'error', 'result' => $dto])->send();
        }

        $this->user = new User($this->dto);
        $this->setTable();
    }

    use setTable;

    private function attempt(): bool
    {
        $user = $this->userRepository->getUserByEmail([
            'table' => $this->table(),
            'where' => ['email' => $this->user->email()]
        ]);
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
            $this->response->json(['href' => '/'])->send();
        }

        $this->response->json(['status' => 'error', 'result' => 'Неверный логин или пароль'])->send();

    }
}
