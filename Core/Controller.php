<?php
/**
 * Created by PhpStorm.
 * User: kiran
 * Date: 04/07/16
 * Time: 12:36
 */

namespace Mvc\Core;


abstract class Controller
{

    /**
     * @var array
     */
    protected $route_params = [];

    /**
     * @param $route_params
     */
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    /**
     * @param $name
     * @param $args
     */
    public function __call($name, $args)
    {
        $method = $name . 'Action';

        if(method_exists($this, $method)) {
            if($this->beforeCall() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->afterCall();
            }
        } else {
            echo "Method $method not found in controller " . get_class($this);

        }

    }

    /**
     *
     */
    protected function beforeCall()
    {

    }

    /**
     *
     */
    protected function afterCall()
    {

    }

}