<?php

namespace Database;
require_once(DIR . DS . 'config' . DS . 'index.php');

class connect
{
    static $error = '';
    static private $host = HOST;
    static private $db_name = DB_NAME;
    static private $username = USERNAME;
    static private $password = PASSWORD;
    private static $instance = NULL;

    private function __construct()
    {
    }

    public static function CreateConnection()
    {
//    $pass = self::Pass_enc();
        if (!isset(self::$instance)) {
            self::$instance = new \PDO('mysql:host=' . self::$host . ';dbname=' . self::$db_name, self::$username, self::$password,
                array(
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8"
                ));
            self::$instance->exec('set names utf8');
        }
        if (self::$instance) {
            return self::$instance;
        } else {
            self::$error = 'Our database is down, Please try again later ..';
            return self::$error;
        }


    }

    private function __clone()
    {
    }

    private function Pass_enc()
    {
        return self::$password = MD5(sha1(self::$password));
    }


}

