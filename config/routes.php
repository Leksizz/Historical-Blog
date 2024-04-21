<?php

use App\Core\Router\Route;
use App\Middlewares\GuestMiddleware;
use App\Сontrollers\MainController;
use App\Сontrollers\RegisterController;

return [
    Route::get('/', [MainController::class, 'index']),
    Route::get('/register', [RegisterController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/register', [RegisterController::class, 'register']),
];