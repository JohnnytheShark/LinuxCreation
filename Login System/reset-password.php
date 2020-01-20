<!DOCTYPE html>
<html>
<head>

</head>
<?php
  require "Objects/nav.html"
?>
<main>
  <h1>Reset Your Password</h1>
  <p>An e-mail will be send to you with instructions on how to reset your password.</p>
  <form action="Includes/reset-request.Con.php" method="POST">
    <input type="text" name="email" placeholder="Enter your e-mail address...">
    <button type="submit" name="resetRequest-Submit">Receive new password by email</button>
  </form>
</main>

<?php
  require "Objects/footer.html"
 ?>
</html>
