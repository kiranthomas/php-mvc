<?php
/**
 * Created by PhpStorm.
 * User: kiran
 * Date: 04/07/16
 * Time: 12:36
 */

namespace Core;


abstract class Controller
{

    protected $route_params = [];

    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

}