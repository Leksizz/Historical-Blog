<?php

namespace App\Core\Storage;

use App\Core\Config\ConfigInterface;

class Storage implements StorageInterface
{

    public function __construct(
        private readonly ConfigInterface $config,
    )
    {
    }

    public function relativePath(string $path): string
    {
        return "../storage/$path";
    }

    public function url(string $path): string
    {
        $url = $this->config->get('app.url', 'http://localhost');
        return "$url/storage/$path";
    }

    public function get(string $path): string
    {
        return file_get_contents(APP_PATH . "../storage/$path");
    }
}