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
 * Composer autoload
 */

use Symfony\Component\HttpFoundation\Request;

require __DIR__ . '/vendor/autoload.php';



/**
 * Custom AutoLoader
 */

//spl_autoload_register(function($class){
//   //$root = dirname(__DIR__);
//   $root = __DIR__;
//   $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
//    if(is_readable($file)) {
//        require $root . '/' . str_replace('\\', '/', $class) . '.php';
//    }
//});


$request = Request::createFromGlobals();


$router = new Mvc\Core\Router();

$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);


//var_dump($router->getRoutes());


$router->dispatch($request->getPathInfo());