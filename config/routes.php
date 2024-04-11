<?php

use App\controllers\ControllerMain;
use App\Kernel\Router\Route;

return [
    Route::get('/', [ControllerMain::class, 'actionIndex']),
];