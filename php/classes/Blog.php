<?php

namespace classes;
class Blog
{
    public static function handlerAddArticle()
    {
        // НАДО ДОДЕЛАТЬ ДЛЯ НЕСКОЛЬКИХ КАРТИНОК
        global $mysqli;
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = $_SESSION['login'];
        // Создаем объект
        $html = new \simple_html_dom();
        // Загружаем предоставленную строку HTML-документа
        $html->load($content);
        // Получаем картинку (data:image/png;base64, кодировка в base64)
        $img = $html->getElementByTagName('img');
        // Получаем служебные данные
        $meta = explode(',', $img->src)[0];
        // Получаем закодированные данные в бинарной формации
        $base64 = explode(',', $img->src)[1];
        // Получаем расширение файла
        $extension = explode(';', explode('/', $meta)[1])[0];
        $filename = "img/blog/" . microtime() . "." . $extension;
        // Открываем файл в режиме бинарной записи
        $ifp = fopen($filename, 'wb');
        // Записываем в файл содержимое
        fwrite($ifp, base64_decode($base64));
        // Закрываем файл
        fclose($ifp);
        // Меняем расположение $img
        $img->src = "/" . $filename;
        $content = $html->save();

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