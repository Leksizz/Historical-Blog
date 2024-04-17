<?php

namespace App\Core\View;

interface ViewInterface
{
    public function render(string $path): void;

    public static function errorCode(string $code): void;

}