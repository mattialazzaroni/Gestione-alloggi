<?php

Class Database
{

    private static $_connection = NULL;



    private function __construct()
    {
        //non faccio nulla
    }

    public static function getConnection()
    {
        if (!self::$_connection) {
            try {
                self::$_connection = new PDO(DSN, MYSQLUSER, MYSQLPASS);
                self::$_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
        return self::$_connection;
    }
}

?>
	
