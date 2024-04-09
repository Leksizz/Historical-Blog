<?php

namespace application\models;

use application\core\Model;

class ModelUser extends Model
{
    private $user;
    private $table;
    private $email;
    public $message;

    public function __construct($user)
    {
        parent::__construct();
        $this->user = $user;
        $this->email = ['email' => $this->user['email']];
        $this->table = 'users';
    }

    public function register()
    {
        $login = ['login' => $this->user['login']];

        if ($this->exists($this->email)) {
            $this->message = 'Такой имейл уже зарегистрирован';
            return false;
        }

        if ($this->exists($login)) {
            $this->message = 'Никнейм уже занят';
            return false;
        }

        password_hash($this->user['password'], PASSWORD_BCRYPT);
        $this->message = 'Регистрация прошла успешно';
        $this->db->insert($this->table, $this->user);
        return true;

    }

    public function login()
    {
        if ($this->exists($this->email)) {
            $row = $this->db->select($this->table, 'password', $this->email);
            if (password_verify($this->user['password'], $row['password'])) {
                $this->message = 'Авторизация прошла успешно';
                return true;
            }
            // Дописать авторизацию
        }
    }

}

