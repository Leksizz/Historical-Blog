<?php

namespace App\Core\Repository;

interface RepositoryInterface
{
    public function save(string $table, array $data);

    public function get(string $table, array $params = []);

    public function edit(string $table, array $params, array $where);

    public function delete();

    public function exists();
}