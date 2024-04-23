<?php

namespace App\Core\DTO;

use App\Core\DTO\Blog\BlogDTO;
use App\Core\DTO\User\UserDTO;
use App\Core\Exceptions\DTOException;
use App\Core\Http\Request\RequestInterface;

class DTOFactory
{
    public static function createFromRequest(RequestInterface $request, string $type): UserDTO|BlogDTO|array
    {
        if (!$request->validate($request->all())) {
            return $request->errors();
        }

        return match ($type) {
            'user' => self::createUserDTO($request),
            'article' => self::createBlogDTO($request),
            default => throw new DTOException("Несуществующий тип DTO"),
        };
    }

    private static function createUserDTO(RequestInterface $request): UserDTO
    {
        $dto = new UserDTO();
        $dto->id = $request->input('id') ?? null;
        $dto->name = $request->input('name');
        $dto->lastname = $request->input('lastname');
        $dto->nickname = $request->input('nickname');
        $dto->email = $request->input('email');
        $dto->password = password_hash($request->input('password'), PASSWORD_BCRYPT);

        return $dto;
    }

    private static function createBlogDTO(RequestInterface $request): BlogDTO
    {
        $dto = new BlogDTO();
//        $dto->id = $request->input('id');
//        $dto->name = $request->input('name');
//        $dto->lastname = $request->input('lastname');
//        $dto->nickname = $request->input('nickname');
//        $dto->email = $request->input('email');
//        $dto->password = $request->input('password');

        return $dto;
    }

}