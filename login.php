<?php
  // Get login info
  $control_number_req = $_POST['control_number'];
  $password_req = $_POST['pass'];
  // Verify user exists
  include_once 'config/Database.php';
  include_once 'models/Assistant.php';

  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $assistant = new Assistant($db);
  $result = $assistant->getLoginInfo();
  $num = $result->rowCount();
  if($num > 0){
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      if($control_number_req == $control_number) {
        if(password_verify($password_req, $password)) {
        // User exists
        session_start();
        $_SESSION['id_assistant'] = $control_number_req;
        echo '<script type="text/javascript">
              window.location = "index.php"
            </script>';
        }
      }
    }
    echo '<script type="text/javascript">
           window.location = "index.php"
        </script>';
  } else {
    echo '<script type="text/javascript">
           window.location = "index.php"
          </script>';
  }
  
  
  
?>