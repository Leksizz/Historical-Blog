<?php

namespace App\Core\DTO;

use App\Core\DTO\Post\PostDTO;
use App\Core\DTO\User\AvatarDTO;
use App\Core\DTO\User\UserDTO;
use App\Core\Exceptions\DTOException;
use App\Core\Http\Request\RequestInterface;

class DTOFactory
{
    /**
     * @throws DTOException
     */
    public static function createFromRequest(RequestInterface $request, string $type): UserDTO|PostDTO|AvatarDTO|array
    {
        if (!$request->validate($request->all())) {
            return $request->errors();
        }
        return match ($type) {
            'user' => self::createUserDTO($request),
            'article' => self::createBlogDTO($request),
            'avatar' => self::createAvatarDTO($request),
            default => throw new DTOException("Несуществующий тип DTO"),
        };
    }

    private static function createAvatarDTO(RequestInterface $request): AvatarDTO|array
    {
        if (!$request->validate(['type' => $request->file('avatar')['type']])) {
            return $request->errors();
        }

        $dto = new AvatarDTO();

        $dto->name = $request->file('avatar')['name'];
        $dto->type = $request->file('avatar')['type'];
        $dto->tmpName = $request->file('avatar')['tmp_name'];
        $dto->error = $request->file('avatar')['error'];
        $dto->size = $request->file('avatar')['size'];

        return $dto;
    }

    private static function createUserDTO(RequestInterface $request): UserDTO|array
    {


        $dto = new UserDTO();

        $dto->id = null;
        $dto->name = $request->input('name') ?? null;
        $dto->lastname = $request->input('lastname') ?? null;
        $dto->nickname = $request->input('nickname') ?? null;
        $dto->email = $request->input('email') ?? null;
        $dto->password = $request->input('password') ?? null;

        return $dto;
    }

    private static function createBlogDTO(RequestInterface $request): PostDTO
    {
        $dto = new PostDTO();
//        $dto->id = $request->input('id');
//        $dto->name = $request->input('name');
//        $dto->lastname = $request->input('lastname');
//        $dto->nickname = $request->input('nickname');
//        $dto->email = $request->input('email');
//        $dto->password = $request->input('password');

        return $dto;
    }

}