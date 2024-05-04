<?php

namespace App\Src\Services\Post\traits;

trait SetTable
{
    private function setTable(): void
    {
        $this->table = 'posts';
    }

    private function table(): string
    {
        return $this->table;
    }
}