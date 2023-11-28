<?php

class Route
{
    public static function view($uri, $path)
    {
        $content = '';
//        дурдом блять 1
//        $result = [];
//        preg_match("/\{(\w+)\}/u", $uri, $result);
//        $param = $result[1];
//        if($param) {
//            $
//        }
//        дурдом блять 2
//        $paths = explode('/', $_SERVER['REQUEST_URI']);
//        if(count($paths)>2) {
//            $uri = explode('/', $uri)[1];
//            $uri = '/' . $uri . '/' . $paths[2];
//        }
        if ($_SERVER['REQUEST_URI'] == $uri && $_SERVER['REQUEST_METHOD'] == 'GET') {
            $content = file_get_contents($path);
            require_once('template.php');
            exit();
        }

    }

    public static function post($uri, $handler)
    {
        if ($_SERVER['REQUEST_URI'] == $uri && $_SERVER['REQUEST_METHOD'] == 'POST') {
            exit($handler());
        }
    }

    public static function get($uri, $handler)
    {
        if ($_SERVER['REQUEST_URI'] == $uri && $_SERVER['REQUEST_METHOD'] == 'GET') {
            exit($handler());
        }
    }
}