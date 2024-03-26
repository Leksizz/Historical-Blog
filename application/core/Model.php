<?php

namespace Core;

abstract class Model
{
    protected $db;

    protected function __construct()
    {
        $this->db = DataBase::getInstance()->getConnection();
    }
}

