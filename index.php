<?php
/**
 * Created by PhpStorm.
 * User: Uzumachi
 * Date: 28.12.2015
 * Time: 15:52
 */

// Activarea vizionarea erorilor
ini_set('display_errors',1);
error_reporting(E_ALL);

// Pornirea sessii
session_start();

// Declarea variabilor constante
define('ROOT_DIR', dirname(__FILE__));
define ( 'ENGINE_DIR', ROOT_DIR . '/engine' );
define ( 'THEME', '/templates/Uzu/' );
define ( 'THEMEERROR', '/templates/Error/' );
define ( 'TPL', 'templates/Uzu/' );
define ( 'TPLADM', 'templates/Admin/' );
define ( 'TPLERROR', 'templates/Error/' );
define( 'TITL', ' - Anunturi.Md');

// Includerea clasei de auto inplementarea altor clase
require_once(ENGINE_DIR.'/components/AutoLoad.php');

// Accesarea Routerului
$router = new Router();
$router->run();
