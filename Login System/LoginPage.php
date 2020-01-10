<?php


// Initialize Login-Session
session_start();

//Check to see if user is logged in, if so redirects the user to welcome page
if(isset($ SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: welcome.php");
  exit;
}


 ?>
