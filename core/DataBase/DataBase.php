<?php

namespace App\Core\DataBase;

use App\Core\Config\ConfigInterface;
use PDO;

class DataBase implements DataBaseInterface
{
    private PDO $pdo;

    public function __construct(private readonly ConfigInterface $config)
    {
        $this->connect();
    }


    private function connect(): void
    {
        $driver = $this->config->get('database.driver');
        $host = $this->config->get('database.host');
        $database = $this->config->get('database.database');
        $username = $this->config->get('database.username');
        $password = $this->config->get('database.password');
        $charset = $this->config->get('database.charset');

        try {
            $this->pdo = new PDO(
                "$driver:host=$host;dbname=$database;charset=$charset",
                $username,
                $password
            );
        } catch (\PDOException $exception) {
            exit("DataBase connection failed: {$exception->getMessage()}");
        }

    }

    public function insert(array $params): int
    {
        $table = $params['table'];
        $data = $params['data'];

        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO" . " $table ($columns) VALUES ($values)";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\PDOException $exception) {
            exit("Insert failed: {$exception->getMessage()}");
        }
        return (int)$this->pdo->lastInsertId();
    }


    public function selectOne(array $params): ?array
    {
        $table = $params['table'];
        $where = $params['where'] ?? [];
        $columns = $params['columns'] ?? ['*'];

        $whereClause = '';
        $columnsClause = '';

        if (!empty($where)) {
            $whereClause = 'WHERE ' . implode(' AND ', array_map(fn($field) => "$field = :$field", array_keys($where)));
        }

        if (!in_array('*', $columns)) {
            $columnsClause = 'SELECT ' . implode(', ', $columns);
        } else {
            $columnsClause = 'SELECT *';
        }

        $sql = "$columnsClause FROM $table $whereClause";

        $stmt = $this->pdo->prepare($sql);

        try {
            $params = [];
            foreach ($where as $key => $value) {
                $params[":$key"] = $value;
            }
            $stmt->execute($params);
        } catch (\PDOException $exception) {
            exit("Select: {$exception->getMessage()}");
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function select(array $params): ?array
    {
        $table = $params['table'];
        $where = $params['where'] ?? [];
        $limit = $params['limit'] ?? null;
        $offset = $params['offset'] ?? null;
        $columns = $params['columns'] ?? ['*'];
        $orderBy = $params['orderBy'] ?? null;
        $orderCondition = $params['orderCondition'] ?? null;

        $whereClause = '';
        $columnsClause = '';
        $limitClause = '';
        $offsetClause = '';
        $orderByClause = '';

        if (!empty($where)) {
            $whereClause = 'WHERE ' . implode(' AND ', array_map(fn($field) => "$field = :$field", array_keys($where)));
        }

        if (!in_array('*', $columns)) {
            $columnsClause = 'SELECT ' . implode(', ', $columns);
        } else {
            $columnsClause = 'SELECT *';
        }

        $sql = "$columnsClause FROM $table $whereClause";

        if ($orderBy !== null) {
            $orderByClause = "ORDER BY $orderBy $orderCondition";
            $sql .= $orderByClause;
        }

        if ($limit !== null) {
            $limitClause = " LIMIT $limit ";
            $sql .= $limitClause;
        }

        if ($offset !== null) {
            $offsetClause = " OFFSET $offset";
            $sql .= $offsetClause;
        }
        $stmt = $this->pdo->prepare($sql);

        try {
            $params = [];
            foreach ($where as $key => $value) {
                $params[":$key"] = $value;
            }
            $stmt->execute($params);
        } catch (\PDOException $exception) {
            exit("Select: {$exception->getMessage()}");
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result ?: null;
    }


    public function update(array $params): bool
    {
        $table = $params['table'];
        $set = $params['set'] ?? [];
        $where = $params['where'] ?? [];

        $setClause = '';
        $whereClause = '';

        if (!empty($set)) {
            $setClause = 'SET ' . implode(', ', array_map(fn($field) => "$field = :$field", array_keys($set)));
        }

        if (!empty($where)) {
            $whereClause = 'WHERE ' . implode(' AND ', array_map(fn($field) => "$field = :$field", array_keys($where)));
        }

        $sql = "UPDATE $table $setClause $whereClause";
        $stmt = $this->pdo->prepare($sql);

        try {
            $params = array_merge($set, $where);
            $stmt->execute($params);
            return true;
        } catch (\PDOException $exception) {
            exit("Update failed: {$exception->getMessage()}");
        }
    }

    public function countColumn(array $params): int
    {
        $table = $params['table'];
        $where = $params['where'] ?? [];

        $whereClause = '';

        if (!empty($where)) {
            $whereClause = 'WHERE ' . implode(' AND ', array_map(fn($field) => "$field = :$field", array_keys($where)));
        }

        $sql = "SELECT " . "COUNT(*) FROM $table $whereClause";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($where);
        } catch (\PDOException $exception) {
            exit("GetCountColumn: {$exception->getMessage()}");
        }

        return $stmt->fetchColumn();
    }

//    public function delete(string $table, array $params = [], array $where = []): bool
//    {
//        $set = '';
//        $whereClause = '';
//
//        if (count($params) > 0) {
//            $set = 'SET ' . implode(' , ', array_map(fn($field) => "$field = :$field", array_keys($params)));
//        }
//
//        if (count($where) > 0) {
//            $whereClause = 'WHERE ' . implode(' AND ', array_map(fn($field) => "$field = :$field", array_keys($where)));
//        }
//
//        $sql = "DELETE $table $set $whereClause";
//        $stmt = $this->pdo->prepare($sql);
//
//        try {
//            $params = array_merge($params, $where);
//            $stmt->execute($params);
//            return true;
//        } catch (\PDOException $exception) {
//            exit("Delete failed: {$exception->getMessage()}");
//        }
//    }
}