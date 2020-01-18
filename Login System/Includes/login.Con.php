<?php

if(isset($_POST['login-submit'])){
  require 'dbh.php';

  $mailuid = pg_escape_string($dbconn,$_POST['mailuid']);
  $password = pg_escape_string($dbconn,$_POST['password']);
//Check to see if the inputs are empty
  if(empty(mailuid)||empty(password)) {
    header("Location: ../index.php?error=emptyfields");
    exit();
//Create a prepared statements
  } else {
    $sql4 = "SELECT * FROM users WHERE username = $1";
    pg_prepare($dbconn,"userNameFetch",$sql4);
      if(!pg_execute($dbconn,"userNameFetch",array($mailuid))){
        header("Location: ../index.php?error=sqlerror");
        exit();
  // Execute the statement and retrieve the data
      } else {
      $execution = pg_execute($dbconn,"username",array($mailuid));
        $results = pg_fetch_result($dbconn,$execution);
        if($row = pg_fetch_assoc()){
          $pwdCheck = password_verify($password, $row['password']);
          if($pwdCheck == false){
            header("Location: ../index.php?error=wrongPassword");
            exit();
          }
          else if($pwdCheck == true){

          }
          else {
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
  header("Location: ../index.php");
  exit();
}


 ?>
