<?php

namespace application\core;

class View
{
    private $path;

    public function __construct($route)
    {
        $this->path = 'application/views/' . $route['action'] . '.html';
    }

    public function render($title, $data = null)
    {
        $content = $this->path;

        if (is_array($data)) {
            extract($data);
        }

        if (!file_exists($content)) {
            echo "Файл не существует";

        }

        require_once('application/views/template.php');
    }

    public function redirect($url)
    {
        header('location: /' . $url);
        exit();
    }

    public static function errorCode($code)
    {
        http_response_code($code);
        require_once 'application/views/' . $code . '.html';
        exit();
    }

    public function message($status, $message)
    {
        exit(json_encode(['status' => $status], ['message' => $message]));
    }

    public function location($url)
    {
        exit(json_encode(['url' => $url]));
    }

}