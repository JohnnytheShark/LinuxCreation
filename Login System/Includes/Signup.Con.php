<?php
// Ensure we are being reached by the submit button
if (isset($_POST['signup-submit'])){

        require 'dbh.php';
        // Claim Variables
        $first = pg_escape_string($dbconn,$_POST['first_name']);
        $last = pg_escape_string($dbconn,$_POST['last_name']);
        $email = pg_escape_string($dbconn,$_POST['email']);
        $username = pg_escape_string($dbconn,$_POST['username']);
        $password = pg_escape_string($dbconn,$_POST['pass']);
        $passwordRepeat = pg_escape_string($dbconn,$_POST['passRepeat']);
        // Check if Fields are Empty
        if (empty($first) || empty($last)||empty($email) || empty($username) || empty($password)){
          header("Location: ../Signup.php?error=emptyfields&username=".$first."&email=".$email);
          exit();
        // Check if the username matches and validate if the email is an email
      } elseif(!preg_match("/[a-zA-Z0-9]*$/", $username) && !filter_var($email,FILTER_VALIDATE_EMAIL)){
            header("Location: ../Signup.php?error=invalidusernameandemail=".$email);
            exit();
        // Check if the email is a valid email
      } elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            header("Location: ../Signup.php?error=emailinvalid&firstname=".$first);
            exit();
        // Check if the username is a proper username
      } elseif(!preg_match("/[a-zA-Z0-9]*$/", $username)) {
          header("Location: ../Signup.php?error=invalidusername=".$email);
          exit();
          // Check if the passwords match
    } elseif($password !== $passwordRepeat){
          header("Location: ../Signup.php?error=passwordrepeaterror=".$email);
          exit();
      // Check if the username is in the database named three because checked afterwards
    } else {
          $sql3 = "SELECT * FROM users WHERE username = $1";
          pg_prepare($dbconn,"userNameverifier",$sql3);
        // Check to see if you can execute the prepared statement
            if(!pg_execute($dbconn,"userNameverifier",array($username))){
              header('Location: ../Signup.php?error=sqlerror3');
              exit();
            } else{
              pg_execute($dbconn,"userNameverifier",array($username));
              $userNameResult = pg_query_params($dbconn,$sql3,array($username));
              $userNameCheck = pg_numrows($userNameResult);
                if($userNameCheck > 0){
                  header("Location: ../Signup.php?error=usernamealreadyinsystem");
                  exit();
                }

        // Pass initial test move on to the next test
          $sql1 = "SELECT * FROM users WHERE email = $1";
          pg_prepare($dbconn,"emailverifier",$sql1);
        // Check to see if you can execute the prepared statement
            if(!pg_execute("emailverifier",array($email))){
              header("Location: ../Signup.php?error=sqlerror1");
              exit();
        // Execute the prepared statement
              } else {
                pg_execute($dbconn,"emailverifier",array($email));
                $result = pg_query_params($dbconn,$sql1,array($email));
                $resultCheck = pg_numrows($result);
        // Test to see if the email is already in the system
                  if($resultCheck > 0){
                    header("Location: ../Signup.php?error=emailalreadyinsystem");
                    exit();
        // Create the registration for the login
                  } else {
        // Hash the password before it is submitted into the SQLiteDatabase
                    $hashedPWD = password_hash($password,PASSWORD_DEFAULT);
                      $sql2 = 'INSERT INTO users (first_name,last_name,email,username,pass) VALUES($1,$2,$3,$4,$5)';
                      pg_prepare($dbconn,"userEmail",$sql2);
                      if(!pg_execute($dbconn,"userEmail",array(($first),($last),($email),($username),($hashedPWD)))){
                        header("Location: ../Signup.php?error=sqlerror2");
                        exit();
        // Execute the Statement
                      } else {
                      pg_execute($dbconn,"userEmail",array(($first),($last),($email),($username),($password)));
                      header("Location: ../Signup.php?signup=Success");
                      exit();
                    }
                  }
                }

              }
}
pg_close($dbconn);
}else {
  header("Location: ../index.php");
  exit();
}
?>
