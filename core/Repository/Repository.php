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

    public function save(array $params): int|false
    {
        return $this->db->insert($params);
    }

    public function one(array $params): ?array
    {
        return $this->db->selectOne($params);
    }

    public function get(array $params): ?array
    {
        return $this->db->select($params);
    }

    public function all(array $params): ?array
    {
        return $this->db->select($params);
    }

    public function edit(array $params): bool
    {
        return $this->db->update($params);
    }

    public function getById(array $params): ?array
    {
        return $this->one($params);
    }

    public function countColumn(array $params): int
    {
        return $this->db->countColumn($params);
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}