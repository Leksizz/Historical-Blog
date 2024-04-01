<?php

use Leksizz\Historical\Blog;
use Leksizz\Historical\OldRoute;
use Leksizz\Historical\User;


//session_start();

//require_once('vendor/autoload.php');
//require_once('db.php');
//
//$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

OldRoute::view('/', 'pages/index.html');
OldRoute::view('/articles/{topic}/{page}', 'pages/articles.html');

OldRoute::get('/getArticlesByTopic/{topic}/{page}', function ($topic, $page){return Blog::getArticlesByTopic($topic, $page);});
OldRoute::get('/getArticle/{id}', function ($id){return Blog::getArticleById($id);});
OldRoute::get('/getArticles', function (){return Blog::getArticles();});
OldRoute::get('/getUserData', function (){return User::getUserData();});
OldRoute::get('/logout', function (){return User::logout();});
OldRoute::get('/article/{id}', function ($id){ Blog::updateViews($id);
return OldRoute::view('/article/{id}', 'pages/article.html');
});

if (!empty($_SESSION['id'])) {
    OldRoute::view('/profile', 'pages/profile.html');
    OldRoute::view('/addArticle','pages/addArticle.html');
    OldRoute::get('/reg', function(){ return header("Location: /");});
    OldRoute::get('/login', function(){ return header("Location: /");});
    OldRoute::post('/handlerAddArticle', function () {return Blog::handlerAddArticle();});
    OldRoute::post('/changeAvatar', function (){return User::changeUserAvatar();});
    OldRoute::post('/deleteAvatar', function (){return User::deleteAvatar();});
} else {
    OldRoute::view('/reg', 'pages/reg.html');
    OldRoute::view('/login', 'pages/login.html');
    OldRoute::post('/handlerReg', function () {return User::handlerReg();});
    OldRoute::post('/handlerLogin', function () {return User::handlerLogin();});
    header("Location: /login");
}