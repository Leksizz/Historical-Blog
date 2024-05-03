<?php

namespace App\Core\Repository;

use App\Core\DataBase\DataBaseInterface;

abstract class Repository implements RepositoryInterface
{

    protected DataBaseInterface $db;

    public function __construct(DataBaseInterface $db)
    {
        $this->db = $db;
    }

    public function save(string $table, array $data): int|false
    {
        return $this->db->insert($table, $data);
    }

    public function get(string $table, array $params = []): ?array
    {
        return $this->db->select($table, $params);
    }

    public function edit(string $table, array $params, array $where): bool
    {
        return $this->db->update($table, $params, $where);
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function exists()
    {
        // TODO: Implement exists() method.
    }

}