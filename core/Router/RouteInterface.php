<?php

namespace App\Core\Router;

interface RouteInterface
{
    public static function get(string $uri, $action, array $middlewares = []): static;

    public static function post(string $uri, $action, array $middlewares = []): static;

    public function getUri(): string;

    public function getAction();

    public function getMethod(): string;

    public function hasMiddlewares(): bool;

    public function getMiddlewares(): array;
}