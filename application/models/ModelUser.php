<?php

namespace application\models;

use application\core\Model;

class ModelUser extends Model
{
    private $user;
    private $email;
    private $login;

    public function __construct($user)
    {
        parent::__construct();
        $this->user = $user;
        $this->user['password'] = password_hash($this->user['password'], PASSWORD_BCRYPT);
        $this->email = ['email' => $user['email']];
        $this->login = ['login' => $user['login']];
    }


    public function register()
    {
        // Дописать, чтобы выводилось сообщение о том, что никнейм занят
        if ($this->exists($this->email)) {
            return false;
        } elseif ($this->exists($this->login)) {
            return false;
        } else {
            $this->db->insert('users', $this->user);
            return true;
        }
    }

    private function exists($value)
    {
        if (empty($this->db->selectAll('users', $value))) {
            return false;
        } else {
            return true;
        }
    }

}

