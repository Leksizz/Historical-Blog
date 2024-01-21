<?php

use classes\Blog;
use classes\User;

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'blog');
require_once('php/classes/User.php');
require_once('php/classes/Blog.php');
require_once('php/classes/Route.php');
require_once('vendor/autoload.php');

Route::view('/', 'pages/main.html');
Route::view('/articles/{topic}/{page}', 'pages/articles.html');

Route::get('/getArticlesByTopic/{topic}/{page}', function ($topic, $page){return Blog::getArticlesByTopic($topic, $page);});
Route::get('/getArticle/{id}', function ($id){return Blog::getArticleById($id);});
Route::get('/getArticles', function (){return Blog::getArticles();});
Route::get('/getUserData', function (){return User::getUserData();});
Route::get('/logout', function (){return User::logout();});
Route::get('/article/{id}', function ($id){ Blog::updateViews($id);
return Route::view('/article/{id}', 'pages/article.html');
});

if (!empty($_SESSION['id'])) {
    Route::view('/profile', 'pages/profile.html');
    Route::view('/addArticle','pages/addArticle.html');
    Route::get('/reg', function(){ return header("Location: /");});
    Route::get('/login', function(){ return header("Location: /");});
    Route::post('/handlerAddArticle', function () {return Blog::handlerAddArticle();});
    Route::post('/changeAvatar', function (){return User::changeUserAvatar();});
    Route::post('/deleteAvatar', function (){return User::deleteAvatar();});
} else {
    Route::view('/reg', 'pages/reg.html');
    Route::view('/login', 'pages/login.html');
    Route::post('/handlerReg', function () {return User::handlerReg();});
    Route::post('/handlerLogin', function () {return User::handlerLogin();});
    header("Location: /login");
}