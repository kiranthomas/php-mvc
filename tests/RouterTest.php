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

    public function testMatchReturnFalseWhenRouteNotFound()
    {
        $router = new Router();
        $router->add('{controller}/{action}');

        $url = 'testController/testAction/test';
        $result = $router->match($url);

        $this->assertFalse($result);

    }

    public function testMatchReturnTrueWhenRouteFound()
    {
        $router = new Router();
        $router->add('{controller}/{action}');

        $url = 'users/new';
        $result = $router->match($url);
        $this->assertTrue($result);
    }

    public function testMatchIsSettingParamsWhenRouteFound()
    {
        $router = new Router();
        $router->add('{controller}/{action}');

        $url = 'users/new';
        $router->match($url);

        $this->assertInternalType('array',$router->getParams());
        $this->assertCount(2,$router->getParams());
    }

    public function testRouteParamsReturnExpected()
    {
        $router = new Router();
        $router->add('{controller}/{action}');

        $url = 'users/new';
        $router->match($url);

        $this->assertArrayHasKey('controller', $router->getParams());
        $this->assertArrayHasKey('action', $router->getParams());
        $this->assertContains('users', $router->getParams());
        $this->assertContains('new', $router->getParams());
    }

    public function testRouteParamsWithIdReturnExpected()
    {
        $router = new Router();
        $router->add('{controller}/{id:\d+}/{action}');

        $url = 'users/23/edit';
        $router->match($url);


        $this->assertCount(3,$router->getParams());
        $this->assertArrayHasKey('controller', $router->getParams());
        $this->assertArrayHasKey('action', $router->getParams());
        $this->assertArrayHasKey('id', $router->getParams());
        $this->assertContains('users', $router->getParams());
        $this->assertContains('edit', $router->getParams());
        $this->assertContains('23', $router->getParams());


    }


}