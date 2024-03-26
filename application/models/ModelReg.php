<?php

namespace models;

use Core\DataBase;
use Core\Model;

class ModelReg extends Model
{
    private $user;


    public function __construct($user)
    {
        parent::__construct();
        $user['password'] = password_hash($user['password'], PASSWORD_BCRYPT);
        $this->user = $user;
    }


    public function register()
    {
        $db = DataBase::getInstance();
//        if ($db->findAll( ) {
//            return json_encode(['result' => 'error']);
//        } else {
//            $db->insert('users', $this->user);
//        } // доделать проверку имейла
        return json_encode(['result' => 'success']);
    }
}

