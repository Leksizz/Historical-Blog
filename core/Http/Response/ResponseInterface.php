<?php

namespace App\Core\Http\Response;

interface ResponseInterface
{
    public function getResponseCode(): int;
    public function headers(): array;
    public function getContent(): string;
    public function json(array $data, int $code, int $options): JsonResponse;
    public function send(): void;
}