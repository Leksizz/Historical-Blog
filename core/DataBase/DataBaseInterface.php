<?php

namespace App\Core\DataBase;

interface DataBaseInterface
{
    public function insert(array $params): int;

    public function selectOne(array $params): ?array;

    public function select(array $params): ?array;

    public function update(array $params): bool;

    public function countColumn(array $params): int;

    public function delete(array $params): bool;
}