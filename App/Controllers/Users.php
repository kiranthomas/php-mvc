<?php
/**
 * Created by PhpStorm.
 * User: kiran
 * Date: 04/07/16
 * Time: 09:54
 */

namespace App\Controllers;

use Core\Controller;
use Core\View;

class Users extends Controller
{

    public function indexAction()
    {
        View::renderTemplate('Users/index.html.twig',[
            'name' => 'test',
            'values' => ['1', '2', '3']
        ]);

    }

//    protected function beforeCall()
//    {
//        echo "before calling the index action";
//    }
//
//
//    protected function afterCall()
//    {
//        echo "after calling the index action";
//    }

}