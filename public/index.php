<?php

define("APP_PATH", dirname(__DIR__));

require_once(APP_PATH . '/vendor/autoload.php');

require_once(APP_PATH . '/config/db.php');

use App\Kernel\App;

session_start();

$app = new App();

$app->run();