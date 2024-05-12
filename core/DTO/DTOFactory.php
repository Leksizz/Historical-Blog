<?php

namespace App\Core\DTO;

use App\Core\Exceptions\DTOException;
use App\Core\Http\Request\RequestInterface;
use App\Src\DTO\Comment\CommentDTO;
use App\Src\DTO\Post\PostDTO;
use App\Src\DTO\User\AvatarDTO;
use App\Src\DTO\User\UserDTO;

class DTOFactory implements DTOFactoryInterface
{
    /**
     * @throws DTOException
     */
    public static function createFromRequest(RequestInterface $request, string $type): UserDTO|PostDTO|AvatarDTO|CommentDTO|array
    {
        return match ($type) {
            'user' => self::createUserDTO($request),
            'avatar' => self::createAvatarDTO($request),
            'post' => self::createPostDTO($request),
            'comment' => self::createCommentDTO($request),
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
        if (!$request->validate($request->all())) {
            return $request->errors();
        }

        $dto = new UserDTO();

        $dto->name = $request->input('name') ?? null;
        $dto->lastname = $request->input('lastname') ?? null;
        $dto->nickname = $request->input('nickname') ?? null;
        $dto->email = $request->input('email') ?? null;
        $dto->password = $request->input('password') ?? null;

        return $dto;
    }

    private static function createPostDTO(RequestInterface $request): PostDTO|array
    {
        if (!$request->validate(['type' => $request->file('preview')['type']]) ||
            !$request->validate(['type' => $request->file('mainImage')['type']])) {
            return $request->errors();
        }

        $dto = new PostDTO();
        $dto->title = $request->input('title');
        $dto->preview = $request->file('preview');
        $dto->content = $request->input('content');
        $dto->mainImage = $request->file('mainImage');
        $dto->category = $request->input('category');

        return $dto;
    }

    private static function createCommentDTO(RequestInterface $request): CommentDTO|array
    {
        if (!$request->validate($request->all())) {
            return $request->errors();
        }

        $dto = new CommentDTO();
        $dto->comment = $request->input('comment');

        return $dto;
    }
}