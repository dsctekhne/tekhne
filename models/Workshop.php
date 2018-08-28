<?php
  class Workshop {
    // DB
    private $conn;
    private $table = 'workshops';

    public $id_workshop;
    public $title;
    public $quota;
    public $id_instructor;

    //Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    // Insert new workshop
    public function newWorkshop($schedule) {
      $query = '
        INSERT INTO
        '.$this->table.'
        (
          title,
          capacity
        ) VALUES (
          "'.$this->title.'",
          "'.$this->quota.'"
        )
      ';
      $this->conn->exec($query);
      for ($i=0; $i < count($schedule); $i++) { 
        $query = '
          INSERT INTO
          workshop_schedule
          (
            id_workshop,
            hour_start,
            hour_end,
            date,
            place
          ) VALUES (
            (SELECT id_workshop From '.$this->table.' order by id_workshop DESC LIMIT 1),
            "'.$schedule[$i]->day[0]->hour_start.'",
            "'.$schedule[$i]->day[0]->hour_end.'",
            "'.$schedule[$i]->day[0]->date.'",
            "'.$schedule[$i]->day[0]->place.'"
          )
        ';
        $this->conn->exec($query);
      }
      $query = '
        INSERT INTO
        workshop_instructor
        (
          id_instructor,
          id_workshop
        ) VALUES (
          "'.$this->id_instructor.'",
          (SELECT id_workshop From '.$this->table.' order by id_workshop DESC LIMIT 1)
        )
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Get all info from specific workshop
    public function getInfoWorkshop($id_workshop) {
      $query = '
        SELECT *
        FROM
        (workshops w INNER JOIN (workshop_instructor wi INNER JOIN instructors i
        ON wi.id_instructor = i.id_instructor) 
        ON w.id_workshop=wi.id_workshop) WHERE w.id_workshop = '.$id_workshop.';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Get all workshops
    public function getAllWorkshops() {
      $query = '
        SELECT *
        FROM
        (workshops w INNER JOIN (workshop_instructor wi INNER JOIN instructors i
        ON wi.id_instructor = i.id_instructor) 
        ON w.id_workshop=wi.id_workshop)
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    public function getSchedule($id_workshop) {
      $query = '
        SELECT 
        *,
        DATE_FORMAT(date, "%y") AS year,
        MONTH(date) AS month,
        DAY(date) AS day
        FROM
        workshop_schedule
        WHERE id_workshop = '.$id_workshop.' ORDER BY date ASC;
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Edit workshop
    public function editWorkshop(
      $id_workshop,
      $title,
      $quota,
      $id_instructor,
      $schedule
    ) {
      $query = '
        UPDATE
        '.$this->table.'
        SET
        title = \''.$title.'\',
        capacity = \''.$quota.'\'
        WHERE id_workshop = \''.$id_workshop.'\';
      ';
      $this->conn->exec($query);
      $query = '
        DELETE FROM
        workshop_schedule
        WHERE id_workshop = '.$id_workshop.';
      ';
      $this->conn->exec($query);
      for ($i=0; $i < count($schedule); $i++) { 
        $query = '
          INSERT INTO
          workshop_schedule
          (
            id_workshop,
            hour_start,
            hour_end,
            date,
            place
          ) VALUES (
            '.$id_workshop.',
            "'.$schedule[$i]->day[0]->hour_start.'",
            "'.$schedule[$i]->day[0]->hour_end.'",
            "'.$schedule[$i]->day[0]->date.'",
            "'.$schedule[$i]->day[0]->place.'"
          )
        ';
        $this->conn->exec($query);
      }
      $query = '
        UPDATE
        workshop_instructor
        SET
          id_instructor = "'.$id_instructor.'",
          id_workshop = "'.$id_workshop.'"
          WHERE id_workshop = \''.$id_workshop.'\';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Delete workshop
    public function deleteWorkshop($id_workshop) {
      $query = '
        DELETE FROM
        '.$this->table.'
        WHERE id_workshop = \''.$id_workshop.'\';
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
    public function setDuration($value) {
      $this->duration = $value;
    }
    public function setQuota($value) {
      $this->quota = $value;
    }
    public function setIdInstructor($value) {
      $this->id_instructor = $value;
    }
    public function getNumberWorkshops() {
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