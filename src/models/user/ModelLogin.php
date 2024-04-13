<?php

namespace App\models\user;

use App\Core\Model\Model;
use App\interfaces\user\setUserDataInterface;

class ModelLogin extends Model implements setUserDataInterface
{
    private $user;
    private $email;

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
    }

    public function login()
    {
        if ($this->isExist($this->email)) {
            $row = $this->db->select($this->table, 'password', $this->email);
            if (password_verify($this->user['password'], $row['password'])) {
                $_SESSION['email'] = $row['email'];
                $this->message = 'Авторизация прошла успешно';
                return true;
            }
        } else {
            $this->message = 'Неверный логин или пароль';
            return false;
        }
    }
}