<?php

class dbConnect {
    private $server = "localhost";
    private $dbname = 'pawheart';
    private $user = "root";
    private $pass = '';
    private $conn; // Add a property to hold the MySQLi connection

    public function connect() {
        $this->conn = new mysqli($this->server, $this->user, $this->pass, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }

    // Add a method to get the MySQLi connection for direct use if needed
    public function getConnection() {
        return $this->conn;
    }
}
?>
