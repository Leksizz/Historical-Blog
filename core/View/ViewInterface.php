<?php

namespace App\Core\View;

interface ViewInterface
{
    public function render(string $path, string $title): void;

    public static function errorCode(string $code): void;

}