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
}