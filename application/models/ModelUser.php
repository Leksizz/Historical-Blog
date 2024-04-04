<?php

namespace application\models;

use application\core\Model;

class ModelUser extends Model
{
    private $user;
    private $email;

    public function __construct($user)
    {
        parent::__construct();
        $this->user = $user;
        $this->user['password'] = password_hash($this->user['password'], PASSWORD_BCRYPT);
        $this->email = ['email' => $user['email']];
    }


    public function register(): bool
    {
        if ($this->userExists()) {
            return false;
        } else {
            $this->db->insert('users', $this->user);
            return true;
        }
    }

    public function userExists()
    {
        if (empty($this->db->selectAll('users', $this->email))) {
            return false;
        } else {
            return true;
        }
    }
}

