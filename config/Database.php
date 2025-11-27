<?php
class Database {
    protected $host = "localhost";
    protected $user = "root";
    protected $password = "";
    protected $db_name = "jdm_workshop";
    protected $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Wrapper untuk eksekusi query
    public function execute($query) {
        return $this->conn->query($query);
    }

    // Wrapper untuk escape string (keamanan)
    public function escapeString($string) {
        return $this->conn->real_escape_string($string);
    }
}
?>