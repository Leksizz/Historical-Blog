<?php

use App\controllers\MainController;
use App\controllers\RegisterController;
use App\Core\Router\Route;

return [
    Route::get('/', [MainController::class, 'index']),
    Route::get('/register', [RegisterController::class, 'index']),
    Route::post('/register', [RegisterController::class, 'register']),
];