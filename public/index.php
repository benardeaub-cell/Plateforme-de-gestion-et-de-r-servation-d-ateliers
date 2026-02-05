<?php

define('BASE_URL', str_replace('\\','/', dirname($_SERVER['SCRIPT_NAME'])) . '/');
session_start();

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../autoloader.php';

use workshop_platform\Autoloader;
use workshop_platform\Core\Router;

Autoloader::register();

$router = new Router();
$router->routes();
