<?php

namespace App\Src\Models\User;

use App\Core\DTO\User\UserDTO;
use App\Core\Session\SessionInterface;

class User
{
    private ?string $name;
    private ?string $lastname;
    private ?string $nickname;
    private ?string $email;
    private ?string $password;

    public function __construct(UserDTO $dto)
    {
        $this->name = $dto->name;
        $this->lastname = $dto->lastname;
        $this->nickname = $dto->nickname;
        $this->email = $dto->email;
        $this->password = password_hash($dto->password, PASSWORD_BCRYPT);
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
            'name' => $this->name,
            'lastname' => $this->lastname,
            'nickname' => $this->nickname,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

}