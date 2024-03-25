<?php

namespace Core;

abstract class Model
{
    protected $db;
    protected $tableName;

    protected function __construct()
    {
        $this->db = DataBase::getInstance()->getConnection();
    }

    protected function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    protected function find()
    {
    }

    protected function findAll()
    {

    }

    protected function insert()
    {
    }

    protected function update()
    {
    }

    protected function delete()
    {
    }
}

