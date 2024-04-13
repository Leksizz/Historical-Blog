<?php

namespace App\models\user;

use App\Core\Model\Model;

class ModelProfile extends Model
{
    public $email;

    public function setEmail()
    {
        $this->email = $_SESSION['email'];
    }

    private function createSession()
    {
        $_SESSION = $this->db->select('users', '*', $this->email);
    }

    public function getSession()
    {
        $this->createSession();
        return json_encode($_SESSION);
    }
}