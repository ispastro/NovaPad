<?php

class Database {
    private $host="aws-0-eu-central-1.pooler.supabase.com" ; // external host
    private $port = "5432"; // external port
    private $db_name = "postgres"; // database name
    // 
    private $username = "postgres.zxqlvdwlgjccvluiezgd";
    private $password = 'MyLaravelDev@2025';
    public $conn;
    

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
            exit;
        }

        return $this->conn;
    }
}

?>
