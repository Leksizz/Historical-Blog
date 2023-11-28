<?php

namespace classes;
class Blog
{
    public static function handlerAddArticle()
    {
        global $mysqli;
        $title = $_POST['title'];
        $content = $_POST['article'];
        $author = $_SESSION['login'];
        $mysqli = new mysqli('localhost', 'root', '', 'blog');
        switch (true) {
            case(empty($title) && empty($content)):
                $_SESSION['error_title'] = "Обязательное поле для ввода";
                $_SESSION['error_article'] = "Обязательное поле для ввода";
                header("Location: /addArticle");
                break;
            case(empty($title)):
                $_SESSION['error_title'] = "Обязательное поле для ввода";
                header("Location: /addArticle");
                break;
            case(empty($content)):
                $_SESSION['error_article'] = "Обязательное поле для ввода";
                header("Location: /addArticle");
                break;
            default:
                $result = $mysqli->query("INSERT INTO articles(title, content, author) VALUES ('$title', '$content', '$author')");
                header("Location: /listArticles");
                break;
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
}