<?php
if (isset($_POST['signup-submit'])){

  require 'DbtCon.php';

  $first = pg_escape_string($dbconn,$_POST['first_name']);
  $last = pg_escape_string($dbconn,$_POST['last_name']);
  $email = pg_escape_string($dbconn,$_POST['email']);
  $username = pg_escape_string($dbconn,$_POST['username']);
  $password = pg_escape_string($dbconn,$_POST['password']);









}


?>
