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
<form action="Includes/login.Con.php" method="POST">
  <fieldset>
    <label for="mailuid">User Name:</label>
    <input type="text" name="mailuid" placeholder="user-name" required>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <button type="submit">Submit</button>
  </fieldset>
</form>

</main>



</body>
<?php
  require "Objects/footer.html"
 ?>
</html>
