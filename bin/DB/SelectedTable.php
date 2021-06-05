<?php


namespace DB;


/**
 * Class SelectedTable
 * მონიშნულ ცხრილზე ოპერაციები
 * @package DB
 */
class SelectedTable extends Table
{
    public function __construct(string $tableName, array $columns = null)
    {
        parent::__construct($tableName);
        if($columns)
         $what =   '('.implode(",", $columns).')';
        else $what = '*';
        $this->sql = "SELECT {$what} FROM {$this->tableName}";
    }

    /**
     * მონიშვნა where პირობით
     * @param string $statement
     * @return $this
     */
    public function where(string $statement): static
    {
        $this->sql .= " where $statement";
        return $this;
    }

    /**
     * იგივეა რაც where მაგრამ პირდაპირ primary key-ით ეძებს
     * @param int $id
     * @return $this
     */
    public  function byId(int $id): static
    {
        $this->sql = "SHOW KEYS FROM {$this->tableName} WHERE Key_name = 'PRIMARY'";
        $primary_key = $this->execute()->fetch()["Column_name"];
        $this->sql  = "SELECT * FROM {$this->tableName} where {$primary_key} = {$id}";
        return $this;
    }
}