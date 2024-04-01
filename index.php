<?php

use Core\Router;
require_once('vendor/autoload.php');
require_once('application/config/db.php');

$router = new Router();
$router->start();