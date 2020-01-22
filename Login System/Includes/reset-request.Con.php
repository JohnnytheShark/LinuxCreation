<?php

if(isset($POST["resetRequest-Submit"])){

  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);

  $url = "www.websitename.com/forgottenpassword/create-new-password.php?selector=".$selector. "&validator=" .bin2hex($token);

  $expires = date("U") + 1800;

  require 'dbh.php';

  $userEmail = pg_escape_string($dbconn,$_POST["email"]);

  $sql = "DELETE FROM password_reset WHERE password_reset_email = $1"
  pg_prepare($dbconn,"passwordReset",$sql);
  if(!pg_execute($dbconn,"passwordReset",array($userEmail))){
    echo "There was an error!";
    exit();
  } else {
    pg_execute($dbconn,"passwordReset"array($userEmail));
  }

  $sql5 = "INSERT INTO password_reset (password_reset_email,password_reset_selector,password_reset_token,password_reset_expires) VALUES ($1,$2,$3,$4)";
  pg_prepare($dbconn,"passwordReset",$sql5);
  if(!pg_execute($dbconn,"passwordReset",array($userEmail),("placeholder"),("placeholder"),("placeholder"))){
    echo "There was an error!";
    exit();
  } else {
    $hashedToken = password_hash($token,PASSWORD_DEFAULT);
    pg_execute($dbconn,"passwordReset"array(($userEmail),($selector),($hashedToken),($expires)));
  }
pg_close($dbconn);

$to = $userEmail;
$subject = 'Reset your password for website';
$message = '<p>We received a password reset request. The link to reset your password is below. If you did not make this request please ignore this email</p>';
$message .= '<p> Here is your password reset link: </br>';
$message .= '<a href="'.$url.'">'. $url . '</a></p>';

$headers = "From: YourName <website@gmail.com>\r\n;";
$headers .= "Reply-To: website@gmail.com\r\n";
$headers .= "Content-type: text/html\r\n";

mail($to,$subject,$message, $headers);

header("Location: ../reset-password.php?reset=success");

} else{
  header("Location: ../index.php");
  exit();
}


 ?>
