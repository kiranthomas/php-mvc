<?php

namespace Mvc\App\Controllers;

use Mvc\App\Models\Post;
use Mvc\Core\Controller;
use Symfony\Component\HttpFoundation\Response;


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

        return new Response($posts);
    }

}