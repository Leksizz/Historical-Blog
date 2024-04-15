<?php

use App\controllers\MainController;
use App\controllers\UserController;
use App\Core\Router\Route;

return [
    Route::get('/', [MainController::class, 'index']),
    Route::get('/register', [UserController::class, 'register']),
    Route::post('/reg', [UserController::class, 'reg']),
];