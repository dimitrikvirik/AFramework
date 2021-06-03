<?php


namespace DB;


use Objects\NotFoundObject;
use PDOException;
use PDOStatement;

class Table
{
    public string $sql = "";
    public array $data = [];
     public function __construct(
         public string $tableName
     )
     {

     }
    /**
     * @param array $data
     * მონაცემის ჩამატება
     */
    public  function insert(array $data): static
    {
        $keys =  '('.implode(', ',array_keys($data)).')';
        $values = '('.implode(', ',
                preg_filter('/^/', ':', array_keys($data))).')';
        $this->sql = "INSERT INTO {$this->tableName} {$keys} VALUES {$values}";

        $this->data = $data;
        return $this;
    }
    public  function select(): SelectedTable
    {
        return new SelectedTable($this->tableName);
    }

    //Execute მეთოდის გადატვირთვა
      function execute (): PDOStatement|string
      {

            $stmt = Connection::$conn->prepare($this->sql);
            $stmt->execute($this->data);
            return $stmt;
    }
}