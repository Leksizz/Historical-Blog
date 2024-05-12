<?php

namespace App\Core\Repository;

use App\Core\DataBase\DataBaseInterface;

abstract class Repository
{

    protected DataBaseInterface $db;

    public function __construct(DataBaseInterface $db)
    {
        $this->db = $db;
    }

    protected function add(array $params): int|false
    {
        return $this->db->insert($params);
    }

    protected function one(array $params): ?array
    {
        return $this->db->selectOne($params);
    }

    protected function get(array $params): ?array
    {
        return $this->db->select($params);
    }

    protected function edit(array $params): bool
    {
        return $this->db->update($params);
    }

    protected function countColumn(array $params): int
    {
        return $this->db->countColumn($params);
    }

    protected function delete(array $params): bool
    {
        return $this->db->delete($params);
    }

    abstract protected function table(): string;
}