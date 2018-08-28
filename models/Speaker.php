<?php
  class Speaker {
    // DB
    private $conn;
    private $table = 'speakers';

    public $id_speaker;
    public $name;
    public $paternal_surname;
    public $maternal_surname;
    public $information;

    //Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    // Insert new speaker
    public function newSpeaker() {
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
    // Get all info from specific speaker
    public function getInfoSpeaker($id_speaker) {
      $query = '
        SELECT * FROM '.$this->table.'  WHERE id_speaker = '.$id_speaker.';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Get all speakers
    public function getAllSpeakers() {
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
    // Edit Speaker
    public function editSpeaker(
      $id_speaker,
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
        WHERE id_speaker = \''.$id_speaker.'\';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Delete speaker
    public function deleteSpeaker($id_speaker) {
      $query = '
        DELETE FROM
        '.$this->table.'
        WHERE id_speaker = \''.$id_speaker.'\';
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
    public function getNumberSpeakers() {
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