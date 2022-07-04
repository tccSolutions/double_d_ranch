<?php


class Database
{


    function connect()
    {
        $db_host = 'localhost';
        $db_name = 'cms';
        $db_user = 'admin';
        $db_password = 'C7ijdcews6aJKUnH';
        $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';
        try {
            return new PDO($dsn, $db_user, $db_password);
        } catch (Exception $e) {
            return $errors[0] = $e->getMessage();
            exit;
        }
    }

}
