<?php

namespace classes;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use KubAT\PhpSimple\HtmlDomParser;

class Blog
{
    public static function handlerAddArticle()
    {
        global $mysqli;
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = $_SESSION['login'];
        $topic = $_POST['topic'];
        $html = HtmlDomParser::str_get_html($content);

        $text = trim($html->find('p', 0)->plaintext);

        $images = $html->find('img');
        $manager = new ImageManager(new Driver());

        foreach ($images as $img) {
            $meta = explode(',', $img->src)[0];
            $base64 = explode(',', $img->src)[1];
            $extension = explode(';', explode('/', $meta)[1])[0];
            $filename = $manager->read($base64);
            $width = $filename->width();
            $height = $filename->height();
            if ($width > 1500 && $height > 1000) {
                $filename->resize(1500, 1000);
            } elseif ($width > 1500) {
                $filename->resize(Width: 1500);
            } elseif ($height > 1000) {
                $filename->resize(Height: 1000);
            } elseif ($width < 300 && $height < 200) {
                return json_encode(['result' => 'errorImage']);
            }
            $path = "img/blog/" . microtime() . "." . $extension;
            $filename->save($path);
            $img->src = "/" . $path;
        }
        $content = $html->save();

        switch (true) {
            case(empty($title) && empty($text)):
                return json_encode(['result' => 'error']);
            case(empty($title)):
                return json_encode(['result' => 'errorTitle']);
            case(empty($text)):
                return json_encode(['result' => 'errorText']);
            case(strlen($text) < 100 && $text >= 1):
                return json_encode(['result' => 'errorTextTooLittleSymbols']);
            case (strlen($text) > 5000):
                return json_encode(['result' => 'errorTextTooMuchSymbols']);
            case (strlen($title) > 250):
                return json_encode(['result' => 'errorTitleTooMuchSymbols']);
            default:
                $mysqli->query("INSERT INTO articles(title, content, author, topic) VALUES ('$title', '$content', '$author', '$topic')");
                return json_encode(['result' => 'success']);
        }
    }

    public static function getArticleById($articleId)
    {
        global $mysqli;
        $result = $mysqli->query("SELECT * FROM articles WHERE id  = '$articleId'");
        return json_encode($result->fetch_assoc());
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
    public static function getArticlesByTopic($topic, $page)
    {
        global $mysqli;
        $limit = 5;
        $offset = ($page - 1) * $limit;
        $sql = "SELECT * FROM articles WHERE topic = '$topic' LIMIT $limit OFFSET $offset";
        $result = $mysqli->query($sql);
        $articles = [];
        while (($row = $result->fetch_assoc()) !== null) {
            $articles[] = $row;
        }
        return json_encode($articles);
    }

}

