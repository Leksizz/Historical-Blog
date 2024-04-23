<?php

namespace App\Core\Repository;

interface RepositoryInterface
{
    public function save(string $table, array $data);

    public function get(string $table, array $params = []);

    public function edit();

    public function delete();

    public function exists();
}