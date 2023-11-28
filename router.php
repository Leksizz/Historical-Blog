<?php

use classes\Blog;
use classes\User;

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'blog');
require_once('php/classes/User.php');
require_once('php/classes/Blog.php');
require_once('php/classes/Route.php');

//Views GET
Route::view('/', 'pages/main.html');
Route::view('/reg', 'pages/reg.html');
Route::view('/login', 'pages/login.html');
Route::view('/profile', 'pages/profile.html');
Route::view('/category', 'pages/category.html');
Route::view('/listArticles', 'pages/listArticles.html');
Route::view('/addArticle','pages/addArticle.html');
Route::view('/article{id}', 'pages/article.html');
// Controllers GET
Route::get('/getArticle', function (){return Blog::getArticleById(1);});
Route::get('/getArticles', function (){return Blog::getArticles();});
Route::get('/getUserData', function (){return User::getUserData();});
Route::get('/logout', function (){return User::logout();});
// Controllers POST
Route::post('/handlerAddArticle', function () {return Blog::handlerAddArticle();});
Route::post('/handlerReg', function () {return User::handlerReg();});
Route::post('/handlerLogin', function () {return User::handlerLogin();});
