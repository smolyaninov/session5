<?php
//debug
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//FRONT CONTROLLER
session_start();

//Подключение файлов системы
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/components/Autoload.php');
spl_autoload_register('Autoload');

//Вызов Router
$router = new Router();
$router->run();