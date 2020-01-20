<?php

if(isset($POST["resetRequest-Submit"])){

  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);

  $url = "www.websitename.com/forgottenpassword/create-new-password.php?selector=".$selector. "&validator=" .bin2hex($token);

  $expires = date("U") + 1800;

  require 'dbh.php'



} else{
  header("Location: ../index.php");
  exit();
}


 ?>
