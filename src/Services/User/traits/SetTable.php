<?php

namespace App\Src\Services\User\traits;

trait setTable
{
    private function setTable(): void
    {
        $this->table = 'users';
    }

    private function table(): string
    {
        return $this->table;
    }
}