<?php


namespace DB;



use PDOStatement;

class Table
{
    public string $sql = "";
    public array $data = [];
     public function __construct(
         public string $tableName
     )
     {}
    /**
     * @param array $data
     * მონაცემის ჩამატება ცხრილში
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

    /**
     * აბრუნებს მონიშნულ ცხრილს
     * @return SelectedTable
     */
    public  function select(): SelectedTable
    {
        return new SelectedTable($this->tableName);
    }

    /**
     * მონაცემის წაშლა შემოწმებით
     * @param $statement
     * @return $this
     */
    public  function delete($statement): static
    {
        $this->sql = "DELETE FROM  {$this->tableName} {$statement}";
        return $this;
    }

    /**
     * ველების განახლება WHERE შემოწმებით
     * @param array $data
     * @param $where
     * @return $this
     */
    public  function update(array $data, $where): static
    {
        $this->sql = "UPDATE $this->tableName SET";

        foreach ($data as $key=>$value){
            $this->sql .= " $key=:$key,";
        }
        $this->sql =  substr($this->sql, 0, -1);
        $this->sql .= " WHERE ".$where;
        $this->data = $data;
        return $this;
    }

    /**
     * საბოლოო ბაზისკენ რექვესტი გაგზავნა
     * @return PDOStatement|string
     */
      function execute (): PDOStatement|string
      {
            $stmt = DB::$conn->prepare($this->sql);
            $stmt->execute($this->data);
            return $stmt;
    }
}