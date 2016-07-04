<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 * Front Controller
 *
 * Created by PhpStorm.
 * User: kiran
 * Date: 26/06/16
 * Time: 15:21
 */


/**
 * AutoLoader
 */

spl_autoload_register(function($class){
   //$root = dirname(__DIR__);
   $root = __DIR__;
   $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if(is_readable($file)) {
        require $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
});

$router = new Core\Router();

$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

$router->dispatch($_SERVER['QUERY_STRING']);