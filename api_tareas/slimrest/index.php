<?php
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

define("ACTIVO", true);
require 'app/libs/conexion.php';
require 'app/routes/api.php';

$app->run();