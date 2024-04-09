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
            $this->message = 'Такой имейл уже зарегистрирован';
            return false;
        }
        if ($this->exists($this->login)) {
            $this->message = 'Никнейм уже занят';
            return false;
        }

        $this->message = 'Регистрация прошла успешно';
        $this->db->insert('users', $this->user);
        return true;
    }
}

