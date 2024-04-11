<?php

namespace App\core;

use App\lib\DataBase;

abstract class Model
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = DataBase::getInstance();
    }

    protected function isExist($value)
    {
        if (empty($this->db->select('users', '*', $value))) {
            return false;
        } else {
            return true;
        }
    }

    protected function setTable($table)
    {
        $this->table = $table;
    }

}

