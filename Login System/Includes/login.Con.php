<?php
//Initialize Session
session_start();
//Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
  header("Location: ../Welcome.php?error=alreadyloggedin");
  exit();
}

//Check to see if the user logged in with the log in system
elseif(isset($_POST['login-submit'])){

  require 'dbh.php';

  $mailuid = pg_escape_string($dbconn,$_POST['mailuid']);
  $password = pg_escape_string($dbconn,$_POST['password']);
//Check to see if the inputs are empty
  if(empty($mailuid)||empty($password)) {
    header("Location: ../index.php?error=emptyfields");
    exit();
//Create a prepared statements
  } else {
    $sql4 = "SELECT * FROM users WHERE username = $1";
    pg_prepare($dbconn,"userNameFetch",$sql4);
//Check to see if you can execute
      if(!pg_execute($dbconn,"userNameFetch",array($mailuid))){
        header("Location: ../index.php?error=sqlerror");
        exit();
  // Execute the statement and retrieve the data
      } else {
    $query = pg_execute($dbconn,"userNameFetch",array($mailuid));
  /*  $results = pg_fetch_result($query,0,2);*/
        if($row = pg_fetch_assoc($query)){
          $pwdCheck = password_verify($password, $row['pass']);
          if($pwdCheck == false){
            header("Location: ../LoginPage.php?error=wrongPassword");
            exit();
          }
          else if($pwdCheck == true){
            session_start();
            $_SESSION['userId'] = $row['username'];
            $_SESSION['name'] = $row['first_name'];
            $_SESSION['loggedin']  = true;

            header("Location: ../Welcome.php?login=success");
            exit();
          } else {
            header("Location: ../index.php?error=wrongPassword");
            exit();
          }
        }
        else {
          header("Location: ../index.php?error=nouser");
          exit();
        }
      }



  }


} else {
  header("Location: ../index.php?error=notloggedin");
  exit();
}


 ?>
