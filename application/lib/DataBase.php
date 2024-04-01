<?php


namespace lib;

use PDO;

class DataBase
{
    private static $instance = null;
    private $db;

    private function __construct()
    {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DataBase();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->db;
    }

    private function executeQuery($sql, $params, $query)
    {
        try {
            $stmt = $this->db->prepare($sql);
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->execute();
            if ($query === 'select') {
                return ($stmt->fetchAll(PDO::FETCH_ASSOC));
            }


        } catch (\PDOException $exception) {
            error_log('DataBase error: ' . $exception->getMessage());
        }
        return false;
    }


    private  function selectBuilder($table, $param, $where = null)
    {
        $sql = "SELECT " . $param . " FROM " . $table;
        if ($where) {
            $value = key($where);
            $sql .= " WHERE $value = :$value";
        }
        return $sql;
    }

    public function select($table, $param, $where = null)
    {
    }

    public function selectAll($table, $where = null)
    {
        $sql = $this->selectBuilder($table, '*', $where);
        return $this->executeQuery($sql, $where, 'select');
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
        return $this->executeQuery($sql, $params, 'insert');
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
