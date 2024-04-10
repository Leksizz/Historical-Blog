<?php

namespace application\models\user;

use application\core\Model;
use application\interfaces\user\setUserDataInterface;

class ModelRegister extends Model implements setUserDataInterface
{
    private $user;
    private $email;
    private $login;
    public $message;

    public function __construct($user)
    {
        parent::__construct();
        $this->setUserData($user);
        $this->setTable('users');
    }

    public function setUserData($user)
    {
        $this->user = $user;
        $this->email = ['email' => $this->user['email']];
        $this->login = ['login' => $this->user['login']];
    }

    public function register()
    {
        if ($this->isExist($this->email)) {
            $this->message = 'Такой имейл уже зарегистрирован';
            return false;
        }

        if ($this->isExist($this->login)) {
            $this->message = 'Никнейм уже занят';
            return false;
        }

        password_hash($this->user['password'], PASSWORD_BCRYPT);
        $this->message = 'Регистрация прошла успешно';
        $this->db->insert($this->table, $this->user);
        return true;

    }
}

