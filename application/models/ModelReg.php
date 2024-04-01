<?php

namespace models;

use Core\Model;
use lib\DataBase;

class ModelReg extends Model
{
    public $user;
    public $email;


    public function __construct($user)
    {
        $user['password'] = password_hash($user['password'], PASSWORD_BCRYPT);
        $this->user = $user;
        $this->email = ['email' => $user['email']];
    }


    public function register()
    {
        $db = DataBase::getInstance();
        if ($db->selectAll('users', $this->email)) {
            return json_encode(['result' => 'error']);
        } else {
            $db->insert('users', $this->user);
            return json_encode(['result' => 'success']);
        }

    }
}

