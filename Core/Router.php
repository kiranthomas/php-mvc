<?php

namespace Mvc\Core;

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
     * @param $url
     */
    public function dispatch($url)
    {
        $url = $this->removeQueryStringVars($url);

        if($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
            $controller = $this->getNameSpace() . $controller;

            if(class_exists($controller)) {
                $controller_object = new $controller($this->params);
                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if(is_callable(array($controller_object, $action))) {
                    $controller_object->$action();
                } else {
                    echo "Method-$action in Controller-$controller Not Found";
                }

            } else {
                echo "Controller Class-$controller Not Found!";
            }

        } else {
            echo "No route matched!";
        }
    }

    /**
     * @param $url
     * @return string
     */
    protected function removeQueryStringVars($url)
    {
        if($url != '') {

            $url = substr($url, 1);

            $parts = explode('&', $url, 2);

            if(strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }

    /**
     * @return string
     */
    protected function getNameSpace()
    {
        $namespace = 'Mvc\App\Controllers\\';

        if(array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }

        return $namespace;
    }

    /**
     * @param $string
     * @return mixed
     */
    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * @param $string
     * @return string
     */
    protected function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
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