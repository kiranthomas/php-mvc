<?php
/**
 * Created by PhpStorm.
 * User: kiran
 * Date: 12/07/16
 * Time: 12:44
 */

namespace Mvc\Core;

use Mvc\App\Config;


abstract class Model
{

    protected static function getDB()
    {
        static $db = null;

        if($db === null) {

            try {
                $dsn = 'mysql:host=' . Config::HOST . ';dbname=' . Config::DB . ';charset=utf8';
                $db = new \PDO($dsn, Config::DBUSER, Config::DBPASS);
                return $db;
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }

    }




}