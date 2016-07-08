<?php

use Mvc\Core\Router;

class RouterTest extends PHPUnit_Framework_TestCase
{

    public function testRouterCanBeInstantiated()
    {
        $r = new Router();
    }

    public function testRoutingTableIsArray()
    {
        $router = new Router();
        $router->add('');

        $this->assertInternalType('array',$router->getRoutes());

    }

    Public function testRoutingTableHasKey()
    {
        $router = new Router();
        $router->add('');
        $router->add('{controller}');
        $router->add('{controller}/{action}');
        $router->add('{controller}/{id:\d+}/{action}');

        $this->assertArrayHasKey('/^$/i', $router->getRoutes());
        $this->assertArrayHasKey('/^(?P<controller>[a-z-]+)$/i', $router->getRoutes());
        $this->assertArrayHasKey('/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/i', $router->getRoutes());
        $this->assertArrayHasKey('/^(?P<controller>[a-z-]+)\/(?P<id>\d+)\/(?P<action>[a-z-]+)$/i', $router->getRoutes());

    }

    public function testRoutingTableHasValue()
    {
        $router = new Router();
        $router->add('', 'User');

        $this->assertContains('User', $router->getRoutes());
    }


}