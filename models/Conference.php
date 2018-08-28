<?php
  class Conference {
    // DB
    private $conn;
    private $table = 'conferences';

    public $id_conference;
    public $title;
    public $hour;
    public $date;
    public $place;
    public $id_speaker;

    //Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    // Insert new conference
    public function newConference() {
      $query = '
        INSERT INTO
        '.$this->table.'
        (
          title,
          hour,
          date,
          place
        ) VALUES (
          "'.$this->title.'",
          "'.$this->hour.'",
          "'.$this->date.'",
          "'.$this->place.'"
        )
      ';
      $this->conn->exec($query);
      $query = '
        INSERT INTO
        conference_speaker
        (
          id_speaker,
          id_conference
        ) VALUES (
          "'.$this->id_speaker.'",
          (SELECT id_conference From '.$this->table.' order by id_conference DESC LIMIT 1)
        )
      ';
      $this->conn->exec($query);
    }
    // Get all info from specific conference
    public function getInfoConference($id_conference) {
      $query = '
        SELECT *
        FROM
        (conferences c INNER JOIN (conference_speaker cs INNER JOIN speakers s
        ON cs.id_speaker = s.id_speaker) 
        ON c.id_conference=cs.id_conference) WHERE c.id_conference = '.$id_conference.';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Get all conferences
    public function getAllConferences() {
      $query = '
        SELECT *
        FROM
        (conferences c INNER JOIN (conference_speaker cs INNER JOIN speakers s
        ON cs.id_speaker = s.id_speaker) 
        ON c.id_conference=cs.id_conference)
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Edit conference
    public function editConference(
      $id_conference,
      $title,
      $hour,
      $date,
      $place,
      $id_speaker
    ) {
      $query = '
        UPDATE
        '.$this->table.'
        SET
        title = \''.$title.'\',
        hour = \''.$hour.'\',
        date = \''.$date.'\',
        place = \''.$place.'\'
        WHERE id_conference = \''.$id_conference.'\';
      ';
      $this->conn->exec($query);
      $query = '
        UPDATE
        conference_speaker
        SET
          id_speaker = "'.$id_speaker.'",
          id_conference = "'.$id_conference.'"
          WHERE id_conference = \''.$id_conference.'\';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Delete conference
    public function deleteConference($id_conference) {
      $query = '
        DELETE FROM
        '.$this->table.'
        WHERE id_conference = \''.$id_conference.'\';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }

    public function setTitle($value) {
      $this->title = $value;
    }
    public function setHour($value) {
      $this->hour = $value;
    }
    public function setDate($value) {
      $this->date = $value;
    }
    public function setPlace($value) {
      $this->place = $value;
    }
    public function setIdSpeaker($value) {
      $this->id_speaker = $value;
    }
    public function getNumberConferences() {
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