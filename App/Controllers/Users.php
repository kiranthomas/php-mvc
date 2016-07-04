<?php
/**
 * Created by PhpStorm.
 * User: kiran
 * Date: 04/07/16
 * Time: 09:54
 */

namespace App\Controllers;

use Core\Controller;

class Users extends Controller
{

    public function indexAction()
    {
        echo "In user Index";

    }

    protected function beforeCall()
    {
        echo "before calling the index action";
    }


    protected function afterCall()
    {
        echo "after calling the index action";
    }

}