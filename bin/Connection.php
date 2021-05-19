<?php
#[Annotation("Connection bin class")]
class Connection{
    public PDO $pdo;
    public static PDO $conn;
    /**
     * Connection constructor.
     * @param string $host
     * @param string $dbname
     * @param string $user
     * @param string $pass
     * @param string $port
     */
    public function __construct(
        private string $host,
        private string $dbname,
        private string $user,
        private string $pass,
        private string $port
    )
    {
       $this->connect();
    }
    //დაუკავშირდეს სერვერს კლასის პარამეტრებით
    public function connect(): void{
        try {
            $this->pdo = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname.";port=".$this->port, $this->user, $this->pass);
            // set the PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            throw new Error("Connection failed: " . $e->getMessage());
        }
    }
    //დაუკავშირდერს სერვერს config.json ფაილის პარამეტრებით
    public static function importConf(){
        $conf = read_conf("server");
        self::$conn =
            (new Connection($conf["host"], $conf["dbname"], $conf["user"], $conf["password"], $conf["port"]))->getPdo();
    }

    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }




}