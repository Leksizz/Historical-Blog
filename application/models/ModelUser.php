<?php

namespace application\models;

use application\core\Model;

class ModelUser extends Model
{
    private $user;
    private $email;
    private $login;

    public $message;

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
        if ($this->exists($this->email)) {
            $this->message = 'Такой email уже занят';
            return false;
        } elseif ($this->exists($this->login)) {
            $this->message = 'Такой никнейм уже занят';
            return false;
        } else {
            $this->message = 'Регистрация прошла успешно';
            $this->db->insert('users', $this->user);
            return true;
        }
    }

    private function sendMessage($message)
    {
        return $this->message = $message;
    }

}

