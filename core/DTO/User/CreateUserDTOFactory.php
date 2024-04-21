<?php

namespace App\Core\DTO\User;

use App\Core\Http\Request\Request;

class CreateUserDTOFactory
{
    public static function fromRequest(Request $request): UserDTO|array
    {
        if (!$request->validate($request->all())) {
            return $request->errors();
        }
        return self::fromArray($request);
    }

    private static function fromArray(Request $request): UserDTO
    {
        $dto = new UserDTO();
        $dto->id = $request->input('id');
        $dto->name = $request->input('name');
        $dto->lastname = $request->input('lastname');
        $dto->nickname = $request->input('nickname');
        $dto->email = $request->input('email');
        $dto->password = $request->input('password');

        return $dto;
    }
}