<?php


class Database
{


    function connect()
    {
        $db_host = 'us-cdbr-east-06.cleardb.net';
        $db_name = 'heroku_ce8889f441fe159';
        $db_user = 'b0b4d2c45ab89d';
        $db_password = 'a550af6c';
        $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';
        try {           
            return new PDO($dsn, $db_user, $db_password);
        } catch (Exception $e) {
            return $errors[0] = $e->getMessage();
            exit;
        }
    }

}

