<?php

namespace classes;

use KubAT\PhpSimple\HtmlDomParser;

class Blog
{
    public static function handlerAddArticle()
    {
        // НАДО ДОДЕЛАТЬ ДЛЯ НЕСКОЛЬКИХ КАРТИНОК
        global $mysqli;
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = $_SESSION['login'];
        $html = HtmlDomParser::str_get_html($content);
        $images = $html->find('img');

        foreach ($images as $img) {
            $meta = explode(',', $img->src)[0];
            $base64 = explode(',', $img->src)[1];
            $extension = explode(';', explode('/', $meta)[1])[0];
            $filename = "img/blog/" . microtime() . "." . $extension;
            $ifp = fopen($filename, 'wb');
            fwrite($ifp, base64_decode($base64));
            fclose($ifp);
            $img->src = "/" . $filename;
            $content = $html->save();
        }
        switch (true) {
            case(empty($title) && empty($content)):
                return json_encode(['result' => 'error']);
            case(empty($title)):
                return json_encode(['result' => 'errorTitle']);
            case(empty($content)):
                return json_encode(['result' => 'errorText']);
            default:
                $mysqli->query("INSERT INTO articles(title, content, author) VALUES ('$title', '$content', '$author')");
                return json_encode(['result' => 'success']);
        }
    }


    public static function getArticleById($articleId)
    {
        global $mysqli;
        $result = $mysqli->query("SELECT * FROM articles WHERE id  = '$articleId'");
        return (json_encode($result->fetch_assoc()));
    }

    public static function getArticles()
    {
        global $mysqli;
        $result = $mysqli->query("SELECT * FROM articles");
        $articles = [];
        while (($row = $result->fetch_assoc()) != null) {
            $articles[] = $row;
        }
        return json_encode($articles);
    }

    public static function updateViews($articleId)
    {
        global $mysqli;
        $mysqli->query("UPDATE articles SET views = views + 1 WHERE id = '$articleId'");
    }
}