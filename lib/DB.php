<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenius
 * Date: 9/17/13
 * Time: 1:03 PM
 * To change this template use File | Settings | File Templates.
 */

class DB extends PDO
{
    protected static $instance = false;

    static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }


    protected function __construct()
    {
        include "conf/dbconn.php";
        parent::__construct($db['dsn'], $db['username'], $db['password']);
    }
}