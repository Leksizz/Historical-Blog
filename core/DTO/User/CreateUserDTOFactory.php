<?php

namespace App\Core\DTO\User;

use App\Core\Http\Request\Request;

class CreateUserDTOFactory
{
    public static function fromRequest(Request $request): UserDTO|array
    {
        $data = $request->all();
        if (!$request->validate($data)) {
            return $request->errors();
        }
        return self::fromArray($data);
    }

    private static function fromArray(array $data): UserDTO
    {
        $dto = new UserDTO();
//        $dto->id = $data['id'];
        $dto->name = $data['name'];
//        $dto->lastname = $data['lastname'];
//        $dto->login = $data['login'];
        $dto->email = $data['email'];
//        $dto->password = $data['password'];

        return $dto;
    }
}