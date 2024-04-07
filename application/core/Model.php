<?php

namespace application\core;

use application\lib\DataBase;

abstract class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = DataBase::getInstance();
    }

    protected function exists($value)
    {
        if (empty($this->db->selectAll('users', $value))) {
            return false;
        } else {
            return true;
        }
    }

}

