<?php

use application\core\Router;
require_once('application/lib/dev.php');
require_once('vendor/autoload.php');
require_once('application/config/db.php');

$router = new Router();
$router->start();