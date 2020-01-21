<?php
  if(isset($_POST['reset-password-submit'])){

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["password-Repeat"]

      if (empty($password) || empty($passwordRepeat)){
        header("Location: ../create-new-password.php?error=emptyfields&selector=".$selector."&validator=".$validator);
        exit();
    } else if($password != $passwordRepeat) {
      header("Location: ../create-new-password.php?error=PassWordnotSame")
      exit();
    }
    $currentDate = date("U");

    require 'dbh.php';




  } else {
    header("Location: ../index.php");
    exit();
  }
 ?>
