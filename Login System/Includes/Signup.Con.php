<?php
// Ensure we are being reached by the submit button
if (isset($_POST['signup-submit'])){

        require 'DbtCon.php';
        // Claim Variales
        $first = pg_escape_string($dbconn,$_POST['first_name']);
        $last = pg_escape_string($dbconn,$_POST['last_name']);
        $email = pg_escape_string($dbconn,$_POST['email']);
        $username = pg_escape_string($dbconn,$_POST['username']);
        $password = pg_escape_string($dbconn,$_POST['pass']);

        // Check if Fields are Empty
        if (empty($first) || empty($last)||empty($email) || empty($username) || empty($password)){
          header("Locaion: ../Signup.php?error=emptyfields&username=".$first."&email=".$email);
          exit();
        // Validate it is an email
        } elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            header("Location: ../Signup.php?error=emailinvalid&firstname=".$first);
            exit();
        // Create a prepared Statement and test it
        } else {
          $sql1 = "SELECT * FROM users WHERE email = $1";
          pg_prepare($dbconn,"emailverifier",$sql1);
        // Check to see if you can create a prepared statement  
            if(!pg_prepare($dbconn,"emailverifier",$sql1)){
              header('Location: ../Signup.php?error=sqlerror1');
              exit();
        // Execute the prepared statement     
              } else {
                pg_execute($dbconn,"emailverifier",array($email));
                $result = pg_query_params($dbconn,$sql1,array($email));
                $resultCheck = pg_numrows($result);
        // Test to see if the email is already in the system        
                  if($resultCheck > 0){
                    header("Location ../Signup.php?error=emailalreadyinsystem");
                    exit();
        // Create the registration for the login
                  } else {
                      $sql2 = 'INSERT INTO users (first_name,last_name,email,username,pass) VALUES($1,$2,$3,$4,$5)';
                      pg_prepare($dbconn,"userEmail",$sql2);
                      if(!pg_prepare($dbconn,"userEmail",$sql2)){
                        header("Location: ../Signup.php?error=sqlerror2");
                        exit();
        // Execute the Statement
                      } else {
                      pg_execute($dbconn,"userEmail",array(($first),($last),($email),($username),($password)));
                      header("Location ../Signup.php?signupSuccess");
                      exit();
                    }
                  }
                }
              }
}
?>
