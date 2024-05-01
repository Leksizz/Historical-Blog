<?php

namespace App\Core\Http\Request;

use App\Core\Upload\FileUploaderInterface;
use App\Core\Validator\ValidatorInterface;

interface RequestInterface
{
    public static function createFromGlobals(): static;

    public function uri(): string;

    public function method(): string;

    public function input(string $key, $default = null): mixed;

    public function all($default = null): mixed;

    public function setValidator(ValidatorInterface $validator): void;

    public function validate(array $data): bool;

    public function errors(): array;
}