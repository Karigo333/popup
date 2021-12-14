<?php

class DB {
    public static PDO $db;

    public static function init()
    {
        try {
            self::$db = new PDO(
                'mysql:host=localhost;dbname=test_task',
                'root',
                'root',
            );

            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "ERROR: Could not connect to the database";
            die();
        }
    }

    public static function query(): PDO
    {
        return self::$db;
    }
}

DB::init();