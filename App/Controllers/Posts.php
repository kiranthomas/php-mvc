<?php

namespace App\Controllers;

use Core\Controller;

/**
 * Created by PhpStorm.
 * User: kiran
 * Date: 03/07/16
 * Time: 10:53
 */
class Posts extends Controller
{
    public function index()
    {
        echo "Inside Posts index controller";

        echo '<pre>';
        var_dump($this->route_params);
    }

}