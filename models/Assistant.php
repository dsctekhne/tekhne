<?php
  class Assistant {
    // DB
    private $conn;
    private $table = 'students';

    public $control_number;
    public $name;
    public $paternal_surname;
    public $maternal_surname;
    public $email;
    public $password;
    public $id_career;

    //Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get all control numbers
    public function getControlNumbers() {
      $query = '
        SELECT 
        control_number
        FROM
        '.$this->table.'
      ;';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Get login info
    public function getLoginInfo() {
      $query = '
        SELECT 
        control_number,
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
    // Insert new assistant
    public function newAssistant() {
      $query = '
        INSERT INTO
        '.$this->table.'
        (
          control_number,
          name,
          paternal_surname,
          maternal_surname,
          email,
          password
        ) VALUES (
          '.$this->control_number.',
          :name,
          :paternal_surname,
          :maternal_surname,
          :email,
          :password
        )
      ;';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(":name", $this->name);
      $stmt->bindParam(":paternal_surname", $this->paternal_surname);
      $stmt->bindParam(":maternal_surname", $this->maternal_surname);
      $stmt->bindParam(":email", $this->email);
      $stmt->bindParam(":password", $this->password);
      // Execute query
      $stmt->execute();
      $query = '
          INSERT INTO
          student_career
          (
            control_number,
            id_career
          )
          VALUES
          (
            '.$this->control_number.',
            '.$this->id_career.'
          );
      ';
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Get all data
    public function getInfoAssistant($control_num) {
      $query = '
        SELECT 
        *
        FROM
        '.$this->table.' s INNER JOIN student_career sc on s.control_number = sc.control_number  
        WHERE s.control_number = '.$control_num.';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Get all assistants
    public function getAllAssistants() {
      $query = '
        SELECT
        *
        FROM
        '.$this->table.'
      ;';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Delete assistant
    public function deleteAssistant($control_number) {
      $query = '
        DELETE FROM
        '.$this->table.'
        WHERE control_number= '.$control_number.'
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Edit assistant
    public function editAssistant(
      $control_number_old,
      $control_number,
      $name,
      $paternal_surname,
      $maternal_surname,
      $email,
      $id_career
    ) {
      $query = '
        UPDATE
        '.$this->table.'
        SET 
          control_number = '.$control_number.',
          name = \''.$name.'\',
          paternal_surname = \''.$paternal_surname.'\',
          maternal_surname = \''.$maternal_surname.'\',
          email = \''.$email.'\'
         WHERE control_number= '.$control_number_old.'
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      $query = '
        UPDATE
        student_career
        SET 
        id_career = '.$id_career.'
        WHERE control_number = '.$control_number.';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    public function registerConferences($control_number) {
      $query = 'CALL registerConferences('.$control_number.');';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    public function isRegisteredAtConferences($control_number) {
      $query = '
      SELECT 
      COUNT(*) AS total 
      FROM conference_student
      WHERE control_number = '.$control_number.'; 
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    public function getAllConferences() {
      $query = '
        SELECT
        *, 
        s.name AS sname,
        s.paternal_surname AS spaternal_surname,
        s.maternal_surname AS smaternal_surname,
        ca.status AS castatus,
        a.name AS aname,
        a.paternal_surname AS apaternal_surname,
        a.maternal_surname AS amaternal_surname,
        ca.id_conference AS caid_conference,
        ca.control_number AS cacontrol_number
        FROM
        ( speakers s INNER JOIN
          ( conference_speaker cs INNER JOIN
            (conferences c INNER JOIN 
              (conference_student ca INNER JOIN
                students a ON ca.control_number = a.control_number
              ) ON c.id_conference = ca.id_conference
            ) ON cs.id_conference = c.id_conference
          ) ON cs.id_speaker = s.id_speaker
        ) 
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    public function getAllConferencesAssRe() {
      $query = '
        SELECT
        DISTINCT(control_number) AS scontrol_number
        FROM conference_student WHERE status = 1;
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    public function updateConferencesAssRe($control_number) {
      $query = '
        INSERT INTO
        conference_student
        (
          control_number,
          id_conference
        ) VALUES (
          '.$control_number.'
          (SELECT id_conference From conferences order by id_conference DESC LIMIT 1),
        )
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
    }
    public function getAllConferenceInfo($id_conference) {
      $query = '
        SELECT
        *, 
        ca.status AS castatus,
        a.name AS aname,
        a.paternal_surname AS apaternal_surname,
        a.maternal_surname AS amaternal_surname,
        ca.id_conference AS caid_conference,
        ca.control_number AS cacontrol_number
        FROM
          (conferences c INNER JOIN 
            (conference_student ca INNER JOIN
              students a ON ca.control_number = a.control_number
            ) ON c.id_conference = ca.id_conference
          )
        WHERE c.id_conference = '.$id_conference.';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    public function getAllConferences2($control_number) {
      $query = '
        SELECT
        *, 
        s.name AS sname,
        s.paternal_surname AS spaternal_surname,
        s.maternal_surname AS smaternal_surname,
        ca.status AS castatus
        FROM
        ( speakers s INNER JOIN
          ( conference_speaker cs INNER JOIN
            (conferences c INNER JOIN 
              (conference_student ca INNER JOIN
                students a ON ca.control_number = a.control_number
              ) ON c.id_conference = ca.id_conference
            ) ON cs.id_conference = c.id_conference
          ) ON cs.id_speaker = s.id_speaker
        ) WHERE ca.control_number =  '.$control_number.';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    public function getAllConferencesAssistantExcel($id_conference) {
      $query = '
        SELECT
        *, 
        a.name AS aname,
        a.paternal_surname AS apaternal_surname,
        a.maternal_surname AS amaternal_surname,
        ca.status AS castatus,
        cr.name AS csname,
        a.control_number AS acontrol_number
        FROM
        ( speakers s INNER JOIN
          ( conference_speaker cs INNER JOIN
            (conferences c INNER JOIN 
              (conference_student ca INNER JOIN
              (students a INNER JOIN (student_career sc INNER JOIN careers cr ON sc.id_career = cr.id_career)
              ON a.control_number = sc.control_number) ON ca.control_number = a.control_number
              ) ON c.id_conference = ca.id_conference
            ) ON cs.id_conference = c.id_conference
          ) ON cs.id_speaker = s.id_speaker
        ) WHERE c.id_conference =  '.$id_conference.' ORDER BY a.paternal_surname ASC, a.maternal_surname ASC, a.name ASC;
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    public function registerWorkshop($control_number, $id_workshop) {
      $query = '
        INSERT INTO
        workshop_student
        (id_workshop, control_number)
        VALUES (
          '.$id_workshop.',
          '.$control_number.'
        )
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    public function isRegisteredAtWorkshop($control_number, $id_workshop) {
      $query = '
      SELECT 
      COUNT(*) AS total 
      FROM workshop_student
      WHERE control_number = '.$control_number.' AND id_workshop = '.$id_workshop.'; 
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    public function getAllWorkshops() {
      $query = '
        SELECT
        *, 
        i.name AS iname,
        i.paternal_surname AS ipaternal_surname,
        i.maternal_surname AS imaternal_surname,
        wa.status AS wastatus,
        a.name AS aname,
        a.paternal_surname AS apaternal_surname,
        a.maternal_surname AS amaternal_surname,
        wa.id_workshop AS waid_workshop,
        wa.control_number AS wacontrol_number
        FROM
        ( instructors i INNER JOIN
          ( workshop_instructor wi INNER JOIN
            (workshops w INNER JOIN 
              (workshop_student wa INNER JOIN
                students a ON wa.control_number = a.control_number
              ) ON w.id_workshop = wa.id_workshop
            ) ON wi.id_workshop = w.id_workshop
          ) ON wi.id_instructor = i.id_instructor
        )
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    public function getAllWorkshops2($control_number) {
      $query = '
        SELECT
        *, 
        i.name AS iname,
        i.paternal_surname AS ipaternal_surname,
        i.maternal_surname AS imaternal_surname,
        wa.status AS wastatus
        FROM
        ( instructors i INNER JOIN
          ( workshop_instructor wi INNER JOIN
            (workshops w INNER JOIN 
              (workshop_student wa INNER JOIN
                students a ON wa.control_number = a.control_number
              ) ON w.id_workshop = wa.id_workshop
            ) ON wi.id_workshop = w.id_workshop
          ) ON wi.id_instructor = i.id_instructor
        ) WHERE wa.control_number =  '.$control_number.';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    public function getAllWorkshopsAssistants($id_workshop) {
      $query = '
        SELECT
        *, 
        a.control_number AS acontrol_number,
        a.name AS aname,
        a.paternal_surname AS apaternal_surname,
        a.maternal_surname AS amaternal_surname,
        wa.status AS wastatus
        FROM
        ( instructors i INNER JOIN
          ( workshop_instructor wi INNER JOIN
            (workshops w INNER JOIN 
              (workshop_student wa INNER JOIN
                students a ON wa.control_number = a.control_number
              ) ON w.id_workshop = wa.id_workshop
            ) ON wi.id_workshop = w.id_workshop
          ) ON wi.id_instructor = i.id_instructor
        ) WHERE wa.id_workshop =  '.$id_workshop.';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    public function getAllWorkshopsAssistantsExcel($id_workshop) {
      $query = '
        SELECT
        *, 
        a.control_number AS acontrol_number,
        a.name AS aname,
        a.paternal_surname AS apaternal_surname,
        a.maternal_surname AS amaternal_surname,
        wa.status AS wastatus,
        cr.name AS csname,
        w.title AS wtitle
        FROM
        ( instructors i INNER JOIN
          ( workshop_instructor wi INNER JOIN
            (workshops w INNER JOIN 
              (workshop_student wa INNER JOIN
                (students a INNER JOIN (student_career cs INNER JOIN careers cr ON cs.id_career = cr.id_career)
                ON a.control_number = cs.control_number) ON wa.control_number = a.control_number
              ) ON w.id_workshop = wa.id_workshop
            ) ON wi.id_workshop = w.id_workshop
          ) ON wi.id_instructor = i.id_instructor
        ) WHERE wa.id_workshop =  '.$id_workshop.' ORDER BY a.paternal_surname ASC, a.maternal_surname ASC, a.name ASC;
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    public function registerPaymentWorkshop($control_number, $id_workshop) {
      $query = '
        UPDATE
        workshop_student
        SET
        status = 1
        WHERE
        id_workshop = '.$id_workshop.' AND
        control_number = '.$control_number.';
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    public function getCurrentQuota($id_workshop) {
      $query = '
        SELECT 
        COUNT(*) as total_registers
        FROM (students a INNER JOIN workshop_student wa ON a.control_number = wa.control_number)  
        WHERE id_workshop = '.$id_workshop.'  AND status = "1" 
        GROUP BY id_workshop;
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    public function setControlNumber($value) {
      $this->control_number = $value;
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
    public function setEmail($value) {
      $this->email = $value;
    }
    public function setPassword($value) {
      $this->password = $value;
    }
    public function setIDCareer($value) {
      $this->id_career = $value;
    }
    public function getNumberAssistants() {
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
    public function getNumberAssistantsConferences() {
      $query = '
      SELECT
      COUNT(DISTINCT ca.control_number) AS total
      FROM
      ( speakers s INNER JOIN
        ( conference_speaker cs INNER JOIN
          (conferences c INNER JOIN 
            (conference_student ca INNER JOIN
              students a ON ca.control_number = a.control_number
            ) ON c.id_conference = ca.id_conference
          ) ON cs.id_conference = c.id_conference
        ) ON cs.id_speaker = s.id_speaker
      );
      ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
  }
?>