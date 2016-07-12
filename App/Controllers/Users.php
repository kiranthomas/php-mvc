<?php
/**
 * Created by PhpStorm.
 * User: kiran
 * Date: 04/07/16
 * Time: 09:54
 */

namespace Mvc\App\Controllers;

use Mvc\Core\Controller;
use Mvc\Core\View;

class Users extends Controller
{

    public function indexAction()
    {
        View::renderTemplate('Users/index.html.twig',[
            'name' => 'test',
            'values' => ['1', '2', '3']
        ]);

    }

}