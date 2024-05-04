<?php

use App\Core\Router\Route;
use App\Src\Controllers\Blog\MainController;
use App\Src\Controllers\Blog\SessionController;
use App\Src\Controllers\Post\AddPostController;
use App\Src\Controllers\Post\PostController;
use App\Src\Controllers\User\AuthController;
use App\Src\Controllers\User\ProfileController;
use App\Src\Controllers\User\RegisterController;
use App\Src\Middlewares\AuthMiddleware;
use App\Src\Middlewares\GuestMiddleware;

return [
    Route::get('/', [MainController::class, 'index']),
    Route::get('/getSession', [SessionController::class, 'sendSession']),
    Route::get('/logout', [AuthController::class, 'logout']),
    Route::get('/register', [RegisterController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/register', [RegisterController::class, 'register']),
    Route::get('/login', [AuthController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/login', [AuthController::class, 'login']),
    Route::get('/profile', [ProfileController::class, 'index'], [AuthMiddleware::class]),
    Route::get('/getUser', [ProfileController::class, 'getUser'], [AuthMiddleware::class]),
    Route::post('/changeAvatar', [ProfileController::class, 'changeAvatar']),
    Route::post('/deleteAvatar', [ProfileController::class, 'deleteAvatar']),
    Route::get('/addPost', [AddPostController::class, 'index'], [AuthMiddleware::class]),
    Route::post('/addPost', [AddPostController::class, 'addPost']),
    Route::get('/post/\d+', [PostController::class, 'index']),
];