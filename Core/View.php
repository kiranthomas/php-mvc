<?php
/**
 * Created by PhpStorm.
 * User: kiran
 * Date: 05/07/16
 * Time: 19:26
 */

namespace Core;


class View
{

    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;

        if($twig === null) {
            $loader = new \Twig_Loader_Filesystem('App/Views');
            $twig = new \Twig_Environment($loader);
        }

        echo $twig->render($template, $args);
    }

}