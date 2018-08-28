<?php
  // Get login info
  $username_req = $_POST['username'];
  $password_req = $_POST['password'];
  // Verify user exists
  include_once '../../config/Database.php';
  include_once '../../models/Users.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $user = new User($db);
  $result = $user->getLoginInfo();
  $num = $result->rowCount();
  if($num > 0){
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      if((strcasecmp($username_req, $username)==0) 
        && (strcasecmp($password_req, $password)==0)){
        // User exists
        session_start();
        $_SESSION['id_user'] = $username_req;
        echo '<script type="text/javascript">
              window.location = "dashboard.php"
            </script>';
      }
    }
    echo '<script type="text/javascript">
           window.location = "../login.php"
        </script>';
  } else {
    echo '<script type="text/javascript">
           window.location = "../login.php"
          </script>';
  }
  
  
  
?>