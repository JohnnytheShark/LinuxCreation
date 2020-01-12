<!DOCTYPE html>
<html>
<head>


</head>
<?php
  require "Objects/nav.html"
?>
<main>
  <h1>Sign Up</h1>
  <fieldset>
  <form action="Includes/Signup.Con.php" method="post">
    <label for="username">User Name:</label><br>
    <input type="text" name="username" placeholder="User-Name" required><br>
    <label for="password">Password:</label><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="password" name="password" placeholder="Repeat Password required"><br>
    <label for="email">E-Mail:</label><br>
    <input type="email" name="email" placeholder="E-Mail" required></input><br>
    <label for="first_name">First Name:</label><br>
    <input type="text" name="first_name" placeholder="First Name" required><br>
    <label for="last_name">Last Name:</label><br>
    <input type="text" name="last_name" placeholder="Last Name" required><br>
    <button type="submit" name="signup-submit">Signup</button>
  </form>
</fieldset>
</main>

<?php
  require "Objects/footer.html"
 ?>
</html>
