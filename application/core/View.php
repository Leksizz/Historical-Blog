<?php

namespace Core;

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
        header('location: /'.$url);
        exit();
    }

}