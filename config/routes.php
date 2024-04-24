<?php

use App\Core\Router\Route;
use App\Src\Controllers\LoginController;
use App\Src\Controllers\MainController;
use App\Src\Controllers\RegisterController;
use App\Src\Middlewares\GuestMiddleware;

return [
    Route::get('/', [MainController::class, 'index']),
    Route::get('/getSession', [MainController::class, 'sendSession']),
    Route::get('/register', [RegisterController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/register', [RegisterController::class, 'register']),
    Route::get('/login', [LoginController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/login', [LoginController::class, 'login']),
];