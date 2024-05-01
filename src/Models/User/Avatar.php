<?php

namespace App\Src\Models\User;

use App\Core\DTO\User\AvatarDTO;

class Avatar
{
    public string $name;
    public string $type;
    public string $tmpName;
    public int $error;
    public int $size;

    public function __construct(AvatarDTO $avatarDTO)
    {
        $this->name = $avatarDTO->name;
        $this->type = $avatarDTO->type;
        $this->tmpName = $avatarDTO->tmpName;
        $this->error = $avatarDTO->error;
        $this->size = $avatarDTO->size;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function tmpName(): string
    {
        return $this->tmpName;
    }

    public function error(): int
    {
        return $this->error;
    }

    public function size(): int
    {
        return $this->size;
    }
}