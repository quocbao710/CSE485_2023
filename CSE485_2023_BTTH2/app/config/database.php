<?php
class DBConnection{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "btth01_cse485";
    private $conn = null;

    public function connect(){
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if($this->conn->connect_error){
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }
        return $this->conn;
    }

    public function getConnection(){
        return $this->conn;
    }
}