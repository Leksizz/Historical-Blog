<?php

use App\Core\Router\Route;
use App\Src\Controllers\AuthController;
use App\Src\Controllers\MainController;
use App\Src\Controllers\ProfileController;
use App\Src\Controllers\RegisterController;
use App\Src\Middlewares\AuthMiddleware;
use App\Src\Middlewares\GuestMiddleware;
use App\Src\Controllers\SessionController;

return [
    Route::get('/', [MainController::class, 'index']),
    Route::get('/getSession', [SessionController::class, 'sendSession']),
    Route::get('/logout', [AuthController::class, 'logout']),
    Route::get('/register', [RegisterController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/register', [RegisterController::class, 'register']),
    Route::get('/login', [AuthController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/login', [AuthController::class, 'login']),
    Route::get('/profile', [ProfileController::class, 'index'], [AuthMiddleware::class]),
    Route::get('/getUser', [SessionController::class, 'sendSession'], [AuthMiddleware::class]),
    Route::post('/file', [ProfileController::class, 'file']),
];