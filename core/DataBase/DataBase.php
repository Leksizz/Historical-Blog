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

    public function insert(string $table, array $data): false|int
    {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO" . " $table " . "($columns) VALUES ($values)";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\PDOException $exception) {
            return false;
        }
        return (int)$this->pdo->lastInsertId();
    }

}