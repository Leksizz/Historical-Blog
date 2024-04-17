<?php

namespace App\Core\Auth;

use App\Core\DataBase\DataBaseInterface;
use App\Core\Session\SessionInterface;

class Auth implements AuthInterface
{

    public function __construct(
        private DataBaseInterface $dataBase,
        private SessionInterface  $session,
    )
    {

    }

    public function attempt(string $username, string $password): bool
    {
        return true;
    }

    public function logout(): void
    {
        // TODO: Implement logout() method.
    }

    public function check(): bool
    {
        return true;   // TODO: Implement check() method.
    }

    public function user(): ?array
    {
        return null;   // TODO: Implement user() method.
    }
}