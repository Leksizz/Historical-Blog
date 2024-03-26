<?php


namespace Core;

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
            if ($query === 'find') {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            if ($query === 'insert') {
                return json_encode(['result' => 'success']);
            }

        } catch (\PDOException $exception) {
            error_log('DataBase error: ' . $exception->getMessage());
        }
        return false;
    }

    private function buildSelectQuery($table, $param, $where)
    {
        $sql = "SELECT " . $param . " FROM " . $table;
        if ($where) {
            $sql .= " WHERE $where = :value";
        }
        return $sql;
    }

//    public function emailExists($email)
//    {
//        $this->findAll('users', 'email');
//    } доделать проверку имейла

    public function find($table, $param, $where = null)
    {
        $sql = $this->buildSelectQuery($table, $param, $where);
        return $this->executeQuery($sql, ['value' => $where], 'find');
    }

    public function findAll($table, $where = null)
    {
        $sql = $this->buildSelectQuery($table, '*', $where);
        return $this->executeQuery($sql, ['value' => $where], 'find');
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

