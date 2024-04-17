<?php

namespace App\Core\Http\Response;

interface ResponseInterface
{
    public function setResponseCode(int $code): void;

    public function getResponseCode(): int;

    public function setHeaders(array $headers): void;

    public function headers(): array;

    public function setContent(string $content): void;

    public function getContent(): string;

    public function json(array $data, int $code, int $options): JsonResponse;
}