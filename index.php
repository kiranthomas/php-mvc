<?php
/**
 * Front Controller
 *
 * Created by PhpStorm.
 * User: kiran
 * Date: 26/06/16
 * Time: 15:21
 */

require 'Core/Router.php';



$router = new Router();

$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');



//display the routing table
echo " Requested URL= ". $_SERVER['QUERY_STRING'];

$url = $_SERVER['QUERY_STRING'];

echo '<pre>';
var_dump($router->getRoutes());

echo '<pre>';





var_dump($router->match($url));

var_dump($router->getParams());

