<?php

namespace App\Core\DataBase;

interface DataBaseInterface
{
    public function insert(string $table, array $data): int|false;
}