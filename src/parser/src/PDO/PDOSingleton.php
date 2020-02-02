<?php

namespace Parser\PDO;

use PDO;

class PDOSingleton
{
    private static $DB_HOST = 'mysql';
    private static $DB_USERNAME = 'shop';
    private static $DB_PASSWORD = 'shop';
    private static $DB_NAME = 'shop';
    private static $DB_PORT = 3306;

    private static $instance = null;

    private function __construct() {}

    public static function getInstance(): PDO
    {
        if (self::$instance instanceof PDO) {
//            self::setCharset();
            return self::$instance;
        }

        self::$instance = new PDO(
            "mysql:host=".self::$DB_HOST.";port=".self::$DB_PORT.";dbname=".self::$DB_NAME,
            self::$DB_USERNAME,
            self::$DB_PASSWORD,
            [PDO::ATTR_PERSISTENT => true]
        );

//        self::setCharset();
        return self::$instance;
    }

    private static function setCharset()
    {
        self::getInstance()->query("SET NAMES 'utf8'");
        self::getInstance()->query("SET CHARACTER SET utf8;");
        self::getInstance()->query("SET character_set_connection=utf8;");
    }
}