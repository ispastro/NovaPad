<?php

class Database{

    private $host="localhost";
    private $db_name="note_pad";
    private $username ="root";
    private $password ="MyLaravelDev@2025";
    public $conn;

    public function connect(){
        $this->conn=null;
        try{
            $this->conn=new PDO(
                "mysql:host=".$this->host.";dbname=".$this->db_name.";charset=utf8",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
            exit;

        }

        return $this->conn;
    }

}

?>
