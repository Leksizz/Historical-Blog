<?php

namespace App\Core\Storage;

interface StorageInterface
{
    public function relativePath(string $path): string;

    public function url(string $path): string;

    public function get(string $path): string;
}