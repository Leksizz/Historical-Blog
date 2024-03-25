<?php

namespace models;

use Core\Model;

class ModelReg extends Model
{
    private $user;

    public function __construct($data)
    {
        $this->setUser($data);
        parent::__construct();
    }

    public function setUser($data)
    {
        $this->user = $data;
    }

}