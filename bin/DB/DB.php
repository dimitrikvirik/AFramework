<?php

/**
 * Class DB
 * მონაცემთა ბაზებთან მუშაობა
 */
namespace  DB;
use PDOException;
use PDOStatement;

class DB
{

     static function Table(string $tableName): Table{
         return new Table($tableName);
     }
    /**
     * დაუკავშირდება მონაცემთა ბაზებს კონფიგ ფაილით
     */
     static function run(){
        Connection::importConf();
    }
}