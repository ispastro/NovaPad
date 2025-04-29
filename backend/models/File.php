<?php

class File {
    private $conn;
    private $table = 'files'; // table name

    public $id;
    public $filename;
    public $content;
    public $created_at;
    public $updated_at;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create(){
        $query = "INSERT INTO " . $this->table . " (filename, content) VALUES (:filename, :content)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':filename', $this->filename);
        $stmt->bindParam(':content', $this->content);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // (later we'll add list, delete, etc.)
}

?>
