<?php

namespace App\Core\View;

class View
{
//    private $path;

//    public function __construct($route)
//    {
//        $this->path = 'application/views/' . $route['controller'] . '/' . $route['action'] . '.html';
//    }

    public function render($path): void
    {
        $path = APP_PATH . "/views/$path.html";

        if (!file_exists($path)) {
            throw new \Exception("View $path not found");
        }

        $content = file_get_contents("$path");
        $GLOBALS['content'] = $content;

        require_once APP_PATH . '/views/template/template.php';
    }



//    public function redirect($url)
//    {
//        header('location: /' . $url);
//        exit();
//    }
//
//    public static function errorCode($code)
//    {
//        http_response_code($code);
//        require_once 'application/views/errors/' . $code . '.html';
//        exit();
//    }
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