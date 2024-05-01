<?php

namespace App\Src\Models\User;

use App\Core\DTO\User\UserDTO;

class User
{
    private ?int $id;
    private ?string $name;
    private ?string $lastname;
    private ?string $nickname;
    private ?string $email;
    private ?string $password;

    public function __construct(UserDTO $userDTO)
    {
        $this->id = $userDTO->id;
        $this->name = $userDTO->name;
        $this->lastname = $userDTO->lastname;
        $this->nickname = $userDTO->nickname;
        $this->email = $userDTO->email;
        $this->password = password_hash($userDTO->password, PASSWORD_BCRYPT);
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function lastname(): string
    {
        return $this->lastname;
    }

    public function nickname(): string
    {
        return $this->nickname;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function get(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'nickname' => $this->nickname,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

}