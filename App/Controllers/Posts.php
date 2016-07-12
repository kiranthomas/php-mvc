<?php

namespace Mvc\App\Controllers;

use Mvc\App\Models\Post;
use Mvc\Core\Controller;
use Mvc\Core\View;


/**
 * Created by PhpStorm.
 * User: kiran
 * Date: 03/07/16
 * Time: 10:53
 */
class Posts extends Controller
{
    public function indexAction()
    {
        $posts = Post::getAll();
        View::renderTemplate('Posts/index.html.twig', ['posts' => $posts]);
    }

}