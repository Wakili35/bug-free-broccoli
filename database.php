<?php

class Database {
// declaring variables
private static $writeDatabaseConnection;
private static $readDatabaseConnection;

// writing to the database
public static function connectWriteDatabase (){
    if(self::$writeDatabaseConnection === null) {
        self::$writeDatabaseConnection = new PDO('mysql:host=localhost;dbname=skilld_db;utf-8', 'root', 'root');
        self::$writeDatabaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$writeDatabaseConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    return self::$writeDatabaseConnection;
}

// returning course details
public static function connectReadDatabase (){
    if(self::$readDatabaseConnection === null) {
        self::$readDatabaseConnection = new PDO('mysql:host=localhost;db=skilld_db;utf-8', 'root', 'root');
        self::$readDatabaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$readDatabaseConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    return self::$readDatabaseConnection;
}

}

?>