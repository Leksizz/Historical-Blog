<?php

namespace App\Core\Session;

class Session implements SessionInterface
{
    public function __construct()
    {
        session_start();
    }

    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key, $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    public function setColumn(string $key, string $column, mixed $value): void
    {
        $_SESSION[$key][$column] = $value;
    }

    public function getColumn(string $key, string $column, $default = null): mixed
    {
        return $_SESSION[$key][$column];
    }

    public function getFlash(string $key, $default = null): mixed
    {
        $value = $this->get($key, $default);
        $this->remove($key);

        return $value;
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public function destroy(): void
    {
        session_destroy();
    }

}