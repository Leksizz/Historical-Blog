<?php

use App\Core\Router\Route;
use App\Src\Controllers\AuthController;
use App\Src\Controllers\MainController;
use App\Src\Controllers\ProfileController;
use App\Src\Controllers\RegisterController;
use App\Src\Controllers\SessionController;
use App\Src\Middlewares\AuthMiddleware;
use App\Src\Middlewares\GuestMiddleware;
use App\Src\Controllers\AddPostController;

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
    Route::get('/addPost', [AddPostController::class, 'index']),
    Route::post('/addPost', [AddPostController::class, 'addPost']),
];