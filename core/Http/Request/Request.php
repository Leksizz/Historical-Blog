<?php

namespace App\Core\Http\Request;

use App\Core\Validator\ValidatorInterface;

class Request implements RequestInterface
{

    private ValidatorInterface $validator;

    public function __construct(
        public readonly array $get,
        public readonly array $post,
        public readonly array $server,
        public readonly array $files,
        public readonly array $session,
    )
    {
    }

    public static function createFromGlobals(): static
    {
        return new static($_GET, $_POST, $_SERVER, $_FILES, $_SESSION);
    }

    public function uri(): string
    {
        return strtok($this->server['REQUEST_URI'], '?');
    }

    public function method(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function input(string $key, $default = null): mixed
    {
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }


    public function all($default = null): mixed
    {
        return $this->post ?? $this->get ?? $default;
    }

    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    public function validate(array $data): bool
    {
        return $this->validator->validate($data);
    }

    public function errors(): array
    {
        return $this->validator->errors();
    }

    public function file(string $key): array
    {
        return $this->files[$key];
    }

}