<?php

namespace Mvc\App\Models;


use Mvc\Core\Model;

/**
 * Created by PhpStorm.
 * User: kiran
 * Date: 12/07/16
 * Time: 12:56
 */
class Post extends Model
{

    public static function getAll()
    {
        $db = Model::getDB();

        $stmt = $db->query('select * from posts');

        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $results;


    }

}