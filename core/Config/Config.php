<?php

namespace App\Core\Config;

class Config implements ConfigInterface
{
    public function get(string $key, $default = null): mixed
    {

        [$file, $key] = explode('.', $key);

        $path = APP_PATH . "/config/$file.php";
        if (!file_exists($path)) {
            return $default;
        }
        $config = require $path;
        return $config[$key] ?? $default;
    }
}