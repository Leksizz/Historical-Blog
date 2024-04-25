<?php

namespace App\Core\Upload;

interface FileUploaderInterface
{
    public function move(string $path): string|false;
}