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

    public function insert(string $table, array $data): int
    {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO" . " $table " . "($columns) VALUES ($values)";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\PDOException $exception) {
            exit("Insert failed: {$exception->getMessage()}");
        }
        return (int)$this->pdo->lastInsertId();
    }

    public function first(string $table, array $params = []): ?array
    {
        $where = '';

        $keys = array_keys($params);

        if (count($params) > 0) {
            $where = 'WHERE ' . implode(' AND ', array_map(fn($field) => "field =: $field", $keys));
        }

        $sql = "SELECT " . "*" . " FROM $table $where LIMIT 1";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($params);
        } catch (\PDOException $exception) {
            exit("Find first failed: {$exception->getMessage()}");
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }
}