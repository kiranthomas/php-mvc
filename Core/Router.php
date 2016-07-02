<?php

/**
 * Created by PhpStorm.
 * User: kiran
 * Date: 26/06/16
 * Time: 15:32
 */
class Router
{
    /**
     * Associative array for routes(routing table)
     * @var array
     */
    protected $routes = [];

    /**
     * Parameters from the matched route
     * @var array
     */
    protected $params = [];

    /**
     * Add a route to the routing table
     *
     * @param $route - The route URL
     * @param $params - Parameters (Controller, action, etc..)
     */
    public function add($route, $params = [])
    {
        $route = preg_replace('/\//', '\\/', $route);


        $route = preg_replace('/\{([a-z-]+)\}/', '(?P<\1>[a-z-]+)', $route);

        //convert variable with custom regex
        $route = preg_replace('/\{([a-z ]+):([^\}]+)\}/', '(?P<\1>\2)', $route);



        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    /**
     * Get Routes
     *
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Match the route to the routes in the routing table, setting $params if a route is found.
     *
     * @param $url
     * @return bool
     */
    public function match($url)
    {

        foreach($this->routes as $route => $params) {
            if(preg_match($route, $url, $matches)) {
                foreach($matches as $key => $match) {
                    if(is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;

    }

    /**
     * Get currently matched params
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

}