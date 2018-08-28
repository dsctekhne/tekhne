<?php
  class Career {
    // DB
    private $conn;
    private $table = 'careers';

    public $id_career;
    public $name;
    public $active;

    //Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get all active careers
    public function getActiveCareers() {
      $query = '
        SELECT 
        id_career,
        name
        FROM
        '.$this->table.' WHERE active = 1;
      ;';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Get all careers
    public function getAllCareers() {
      $query = '
        SELECT 
        id_career,
        name
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