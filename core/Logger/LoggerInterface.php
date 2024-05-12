<?php

namespace App\Core\Logger;

interface LoggerInterface
{
    public function write(string $message, string $type): void;

    public function logs(string $type): string|false;
}