<?php
  class Database {
    // DB params
    private $host = 'dsctekhne.com';
    private $db_name = 'dsctekhn_tekhne';
    private $username = 'dsctekhn_user';
    private $password = 'f4c97uL2k?';
    private $conn;

    // DB connect
    public function connect() {
      $this->conn = null;
      try {
        $this->conn = new PDO(
          'mysql:host='.$this->host.';dbname='.$this->db_name,
          $this->username,$this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\'')
        );
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error:' . $e->getMessage();
      }
      return $this->conn;
    }
  }
?>