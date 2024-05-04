<?php

namespace App\Src\Models\User;

use App\Core\DTO\User\AvatarDTO;
use App\Core\Upload\FileUploader;

class Avatar
{
    private string $name;
    private string $type;
    private string $tmpName;
    private int $error;
    private int $size;

    public function __construct(AvatarDTO $dto)
    {
        $this->name = $dto->name;
        $this->type = $dto->type;
        $this->tmpName = $dto->tmpName;
        $this->error = $dto->error;
        $this->size = $dto->size;
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

    public function get(): string
    {
        $avatar = new FileUploader(
            $this->name(),
            $this->type(),
            $this->tmpName(),
            $this->error(),
            $this->size(),
        );
        return $avatar->move('user');
    }
}