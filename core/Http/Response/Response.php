<?php

namespace App\Core\Http\Response;

use JetBrains\PhpStorm\NoReturn;

class Response implements ResponseInterface
{
    private int $code = 200;
    private array $headers = [];
    private string $content = '';


    protected function setResponseCode(int $code): void
    {
        $this->code = $code;
        http_response_code($code);
    }

    public function getResponseCode(): int
    {
        return $this->code;
    }

    protected function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    public function headers(): array
    {
        return $this->headers;
    }

    protected function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function json(array $data = null, int $code = 200, int $options = 0): JsonResponse
    {
        return new JsonResponse($data, $code, $options);
    }

    #[NoReturn] public function send(): void
    {
        exit($this->getContent());
    }

}