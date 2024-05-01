<?php

namespace App\Core\DTO\User;

class UserDTO
{
    public ?int $id;
    public ?string $name;
    public ?string $lastname;
    public ?string $nickname;
    public ?string $email;
    public ?string $password;
    public ?string $avatar;
}