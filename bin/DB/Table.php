<?php


namespace DB;


use Objects\NotFoundObject;
use PDOException;
use PDOStatement;

class Table
{
 public function __construct(
     public string $tableName
 )
 {
 }

    /**
     * @param array $data
     * მონაცემის ჩამატება
     */
    public  function Insert(array $data): void{
        $keys =  '('.implode(', ',array_flip($data)).')';
        $values = '('.implode(', ',
                preg_filter('/^/', ':', array_flip($data))).')';
        $sql = "INSERT INTO {$this->tableName} {$keys} VALUES {$values}";
        $this->execute($sql, $data);
    }
    /**
     * @param int $id
     * @return mixed
     * ყველა მონაცემის ამოკითხვა
     */
    public  function Select(): mixed
    {
        $sql = "SELECT * FROM {$this->tableName}";
        return $this->execute($sql)->fetchAll();
    }

    /**
     * @param int $id
     * @return mixed
     * აიდის მიხედვით მონაცემის ამოკითხვა
     */
    public  function SelectId(int $id,  $obj = null): object
    {
        $sql = "SHOW KEYS FROM {$this->tableName} WHERE Key_name = 'PRIMARY'";
        $primary_key = $this->execute($sql)->fetch()["Column_name"];
        $sql = "SELECT * FROM {$this->tableName} where {$primary_key} = {$id}";
        $obj = $this->execute($sql)->fetchObject($obj);
        if(!$obj){
            header("HTTP/1.0 404 Not Found");
           return new NotFoundObject(404, "Record with id {$id} not found");
        }
      return $obj;
    }


    //Execute მეთოდის გადატვირთვა
      function execute(string $sql, array $data = array()): ?PDOStatement{
        try {

            $stmt = Connection::$conn->prepare($sql);
            $stmt->execute($data);
            return $stmt;
        }catch (PDOException $e){
            $_SESSION["pdoErr"] = $e->getMessage();
        }
        return null;
    }
}