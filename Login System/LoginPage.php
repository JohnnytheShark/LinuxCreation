<!DOCTYPE html>
<html>
<head>
</head>
<?php
  require "Objects/nav.html"
 ?>
<body>
<main>
  <h1>Login:</h1>
<?php
  if(isset($_GET['error'])){
    if($_GET['error']=='wrongPassword'){
      echo '<p class="loginerror">You entered the wrong Password</p>';
    }elseif($_GET['login'] =="success"){
      echo '<p class="login">Login Successful</p>';
    }
  }
 ?>
<form action="Includes/login.Con.php" method="POST">
  <fieldset>
    <label for="mailuid">User Name:</label>
    <input type="text" name="mailuid" placeholder="user-name" required>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <button type="submit"name="login-submit">Login</button>
  </fieldset>
</form>
<p>Don't have an account <a href="Signup.php">Sign-up here</a></p>
</main>
</body>
<?php
  require "Objects/footer.html"
 ?>
</html>
