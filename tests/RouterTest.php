<?php

use Mvc\Core\Router;

class RouterTest extends PHPUnit_Framework_TestCase
{

    public function testRouterCanBeInstantiated()
    {
        $r = new Router();
    }

    public function testGetRoutes()
    {
        $router = new Router();

        $router->add('{controller}/{action}');


    }




}