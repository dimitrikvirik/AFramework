<?php

/**
 * Class DB
 * მონაცემთა ბაზებთან მუშაობა
 */
namespace  DB;
use Error;
use PDO;
use PDOException;

class DB
{
    public static PDO $conn;
     static function Table(string $tableName): Table{
         return new Table($tableName);
     }

    /**
     * კონფიგ ფაილიდან ამატებს პარამატრებს
     */
    public static function importConf(){
        $conf = \Util::ReadConf("server");
        try {
            self::$conn = new PDO("mysql:host=".$conf["host"].";dbname=". $conf["dbname"],$conf["user"],  $conf["password"]);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            throw new Error("Connection failed: " . $e->getMessage());
        }

    }
}