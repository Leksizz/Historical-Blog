<?php

namespace App\Core\Repository;

interface RepositoryInterface
{
    public function save(array $params): int|false;


    public function one(array $params): ?array;

    public function get(array $params): ?array;

    public function all(array $params): ?array;

    public function edit(array $params): bool;

    public function delete();

    public function getById(array $params): ?array;

    public function countColumn(array $params): int;
}