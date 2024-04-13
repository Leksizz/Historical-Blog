<?php

use App\controllers\ControllerMain;
use App\Core\Router\Route;

return [
    Route::get('/', [ControllerMain::class, 'index']),
];