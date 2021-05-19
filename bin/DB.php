<?php

/**
 * Class DB
 * მონაცემთა ბაზებთან მუშაობა
 */

class DB
{
    //მონაცემთა ბაზებში ჩამატება
    public static function insert(string $table, array $data): void{
        $keys =  '('.implode(', ',array_flip($data)).')';
        $values = '('.implode(', ',
            preg_filter('/^/', ':', array_flip($data))).')';
        // "INSERT INTO users (name, surname, sex) VALUES (:name, :surname, :sex)";
        $sql = "INSERT INTO {$table} {$keys} VALUES {$values}";
        self::execute($sql, $data);
    }
    //მონაცემთა ბაზებიდან rows აღება primary key-ით
    public static function select(string $table, int $id){
    $sql = "SHOW KEYS FROM {$table} WHERE Key_name = 'PRIMARY'";
    $primary_key = self::execute($sql)->fetch()["Column_name"];
    $sql = "SELECT * FROM {$table} WHERE {$primary_key} = {$id}";
    return self::execute($sql)->fetch();
    }


    //Execute მეთოდის გადატვირთვა
    private static function execute(string $sql, array $data = array()): PDOStatement{
        try {
            $stmt = Connection::$conn->prepare($sql);
            $stmt->execute($data);
            return $stmt;
        }catch (PDOException $e){
            echo "Error: ".$e->getMessage();
        }
    }

}