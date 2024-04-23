<?php

namespace App\Core\View;

use App\Core\Exceptions\ViewNotFoundException;

class View implements ViewInterface
{
//    private $path;

//    public function __construct($route)
//    {
//        $this->path = 'application/views/' . $route['controller'] . '/' . $route['action'] . '.html';
//    }

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



//    public function redirect($url)
//    {
//        header('location: /' . $url);
//        exit();
//    }
//
    public static function errorCode(string $code): void
    {
        http_response_code($code);
        require_once 'application/views/errors/' . $code . '.html';
        exit();
    }
//
//    public function message($status, $message)
//    {
//        return (json_encode(['status' => $status, 'message' => $message]));
//    }
//
//    public function location($url)
//    {
//        return exit(json_encode(['url' => $url]));
//    }

}