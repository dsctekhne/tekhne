<?php
  class Instructor {
    // DB
    private $conn;
    private $table = 'instructors';

    public $id_instructor;
    public $name;
    public $paternal_surname;
    public $maternal_surname;
    public $information;

    //Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    // Insert new instructor
    public function newInstructor() {
      $query = '
        INSERT INTO
        '.$this->table.'
        (
          name,
          paternal_surname,
          maternal_surname,
          information
        ) VALUES (
          "'.$this->name.'",
          "'.$this->paternal_surname.'",
          "'.$this->maternal_surname.'",
          "'.$this->information.'"
        )
      ';
      $this->conn->exec($query);
    }
    // Get all info from specific instructor
    public function getInfoInstructor($id_instructor) {
      $query = '
        SELECT * FROM '.$this->table.'  WHERE id_instructor = '.$id_instructor.';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Get all instructors
    public function getAllInstructors() {
      $query = '
        SELECT *
        FROM
        '.$this->table.'
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Edit Instructor
    public function editInstructor(
      $id_instructor,
      $name,
      $paternal_surname,
      $maternal_surname,
      $information
    ) {
      $query = '
        UPDATE
        '.$this->table.'
        SET
        name = \''.$name.'\',
        paternal_surname = \''.$paternal_surname.'\',
        maternal_surname = \''.$maternal_surname.'\',
        information = \''.$information.'\'
        WHERE id_instructor = \''.$id_instructor.'\';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Delete instructor
    public function deleteInstructor($id_instructor) {
      $query = '
        DELETE FROM
        '.$this->table.'
        WHERE id_instructor = \''.$id_instructor.'\';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }

    public function setName($value) {
      $this->name = $value;
    }
    public function setPaternalSurname($value) {
      $this->paternal_surname = $value;
    }
    public function setMaternalSurname($value) {
      $this->maternal_surname = $value;
    }
    public function setInformation($value) {
      $this->information = $value;
    }
    public function getNumberInstructors() {
      $query = '
        SELECT COUNT(*) AS total
        FROM '.$this->table.';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
  }

?>