<?php

namespace App\Core\Auth;

interface AuthInterface
{
    public function logout(): void;

    public function check(): bool;

    public function user(): ?array;

    public function table(): string;

    public function email(): string;

    public function password(): string;

    public function sessionField(): string;

    public function admin(): bool;

    public function id(): ?int;
}