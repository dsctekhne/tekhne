<?php
 class User{
   // DB
   private $conn;
   private $table = 'users';

   public $username;
   public $password;

   //Constructor with DB
   public function __construct($db) {
     $this->conn = $db;
   }
   // Get login info
   public function getLoginInfo() {
    $query = '
      SELECT 
      username,
      password
      FROM
      '.$this->table.'
    ;';
    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();
    return $stmt;
  }
 }
?>