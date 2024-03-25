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

    public function getConnection() {
        return $this->db;
    }
}

