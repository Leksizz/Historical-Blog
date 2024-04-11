<?php


namespace App\lib;

use PDO;

class DataBase
{
    private static $instance = null;
    private $db;

    private function __construct()
    {
        $this->db = $this->connection();
    }

    private function connection()
    {
        return new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DataBase();
        }
        return self::$instance;
    }

    private function query($sql, $params)
    {
        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);

        }
        $stmt->execute();
        return $stmt;
    }

    public function select($table, $param, $where = null)
    {
        $sql = "SELECT " . $param . " FROM " . $table;
        if ($where) {
            $value = key($where);
            $sql .= " WHERE $value = :$value";
        }
        $result = $this->query($sql, $where);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($table, $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO" . " $table " . "($columns) VALUES ($values)";
        $params = [];
        foreach ($data as $key => $value) {
            $params[':' . $key] = $value;
        }
        return $this->query($sql, $params);
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
