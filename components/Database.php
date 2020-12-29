<?php

class Database
{
    public static function getDb(): PDO
    {
        $params = include(ROOT . '/config/database.php');
        try {
            $dbh = new PDO('mysql:dbname=' . $params['DB_NAME'] . ';host=' . $params['DB_HOST'],
                $params['DB_USER'], $params['DB_PASS'], [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]);
            if ($dbh instanceof PDO) {
                return $dbh;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}