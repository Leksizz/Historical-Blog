<?php

namespace App\Core\Auth;

use App\Core\Config\ConfigInterface;
use App\Core\DataBase\DataBaseInterface;
use App\Core\Session\SessionInterface;

class Auth implements AuthInterface
{

    public function __construct(
        private readonly DataBaseInterface $db,
        private readonly SessionInterface  $session,
        private readonly ConfigInterface   $config,
    )
    {

    }

    public function logout(): void
    {
        $this->session->remove($this->sessionField());
    }

    public function check(): bool
    {
        return $this->session->has($this->sessionField());
    }

    public function user(): ?array
    {
        if (!$this->check()) {
            return null;
        }

        return $this->db->select($this->table(), [
            'id' => $this->session->get($this->sessionField()),
        ]);
    }

    public function table(): string
    {
        return $this->config->get('auth.table', 'users');
    }

    public function email(): string
    {
        return $this->config->get('auth.email', 'email');
    }

    public function password(): string
    {
        return $this->config->get('auth.password', 'password');
    }

    public function sessionField(): string
    {
        return $this->config->get('auth.session_field', 'user_id');
    }

    public function id(): ?int
    {
        return $this->session->get($this->sessionField());
    }

    public function admin(): bool
    {
        if ($this->session->getColumn('user', 'nickname') === 'Admin') {
            return true;
        }
        return false;
    }
}