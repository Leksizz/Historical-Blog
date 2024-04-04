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
}

