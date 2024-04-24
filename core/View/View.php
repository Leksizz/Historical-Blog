<?php

namespace App\Core\View;

use App\Core\Exceptions\ViewNotFoundException;
use JetBrains\PhpStorm\NoReturn;

class View implements ViewInterface
{
    /**
     * @throws ViewNotFoundException
     */
    public function render(string $path, string $title): void
    {
        $path = APP_PATH . "/views/$path.html";

        if (!file_exists($path)) {
            throw new ViewNotFoundException("View $path not found");
        }

        $GLOBALS['content'] = file_get_contents("$path");
        $GLOBALS['title'] = $title;

        require_once APP_PATH . '/views/template/template.php';
    }

    #[NoReturn] public static function errorCode(string $code): void
    {
        http_response_code($code);
        require_once APP_PATH . "/views/errors/$code.html";
        exit();
    }
}