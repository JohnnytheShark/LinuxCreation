<?php
  if(isset($_POST['reset-password-submit'])){
// Form variables
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["password-Repeat"]
// Check to see if either field is empty
      if (empty($password) || empty($passwordRepeat)){
        header("Location: ../create-new-password.php?error=emptyfields&selector=".$selector."&validator=".$validator);
        exit();
// Check to see if the passwords match
    } else if($password != $passwordRepeat) {
      header("Location: ../create-new-password.php?error=PassWordnotSame")
      exit();
    }
  //Create variables for later
    $currentDate = date("U");
// Connect to the Database
    require 'dbh.php';
// Run prepared statement to find the token that was created
    $sql6 = "SELECT * FROM password_reset WHERE password_reset_selector =$1 AND password_reset_expires >= $currentDate";
    pg_prepare($dbconn,"resetPass",$sql6);
    if(!pg_execute($dbconn,"resetPass",array(($selector),($currentDate)))){
      echo "There was an error!";
      exit();
    } else {
//Execute the query after error check
    $newQuery = pg_execute($dbconn,"resetPass"array(($selector),($currentDate)));
// If you can't fetch the result the person will need to start the whole process over again
      if(!$row = pg_fetch_assoc($newQuery)){
        echo "You need to re-submit your reset request.";
        exit();
      } else {
//Get the variables needed as well as check if the token is active
        $tokenBin = hex2bin($validator);
        $tokenCheck = password_verify($tokenBin, $row["password_reset_token"]);

        if($tokenCheck == false){
          echo "You need to re-submit your reset request.";
          exit();
        } elseif ($tokenCheck === true){

          $tokenEmail = $row["password_reset_email"];
// Create another prepared statement
          $sql7 = "SELECT * FROM users WHERE email = $1;";
          pg_prepare($dbconn,"newPass",$sql7);
          if(!pg_execute($dbconn,"newPass",array($tokenEmail))){
            echo "There was an error!";
            exit();
          } else {
// Execute the prepared statement and bring back an associated array
          $newerQuery = pg_execute($dbconn,"newPass",array($tokenEmail));
            if(!$row = pg_fetch_assoc($newerQuery)){
              echo "There was an error";
              exit();
            } else {
              $sql8 = "UPDATE users SET pass=$1 WHERE email=$2";
              pg_prepare($dbconn,"updater"$sql8);
              if(!pg_execute($dbconn,"updater",array("placeholder"),($tokenEmail)){
                echo "There was an error.";
                exit();
              } else {
                $newPasswordHash = password_hash($password,PASSWORD_DEFAULT);
                pg_execute($dbconn,"updater",array(($newPasswordHash),($tokenEmail)));

                $sql9 = "DELETE FROM password_reset WHERE password_reset_email =$1";
                pg_prepare($dbconn,"destroyToken",$sql9);
                if(!pg_execute($dbconn,"destroyToken",array($tokenEmail))){
                  echo "There was an error!";
                  exit();
                } else {
                  pg_execute($dbconn,"destroyToken",array($tokenEmail));
                  header("Location: ../LoginPage.php?newPassword=PasswordUpdated");
                }  
              }
            }
          }

        }

      }

    }

  } else {
    header("Location: ../index.php");
    exit();
  }
 ?>
