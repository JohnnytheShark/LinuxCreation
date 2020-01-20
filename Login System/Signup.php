<!DOCTYPE html>
<html>
<head>

</head>
<?php
  require "Objects/nav.html"
?>
<main>
  <h1>Sign Up</h1>
  <?php
  //Error Codes to check for
    if(isset($_GET['error'])){
      if($_GET['error'] == "emptyfields") {
        echo '<p class="signuperror">Fill in all fields!</p>';
      } elseif($_GET['error']=="invalidusernameandemail"){
        echo '<p class="signuperror">Username Already Taken</p>';
      } elseif($_GET['error']=="emailinvalid"){
        echo '<p class="signuperror">Email is Invalid</p>';
      } elseif($_GET['error']=="invalidusername"){
        echo '<p class="signup error">Username should only be letters and numbers</p>';
      } elseif($_GET['error']=="passwordrepeaterror"){
        echo '<p class="signuperror">Both Passwords Should Match</p>';
      } elseif($_GET['error']=="usernamealreadyinsystem"){
        echo '<p class="signuperror">Username is already used by someone else</p>';
      }elseif($_GET['error']=="emailalreadyinsystem"){
        echo '<p class="signuperror">Email has already been used</p>';
      }
    //Success Message to submit once the customer has signed up
    } elseif($_GET['signup'] =="Success"){
      echo '<p class="signupsucess">Signup Successful</p>';
    }
   ?>
<!-- SignUp Form -->
  <form action="Includes/Signup.Con.php" method="POST">
    <fieldset>
    <label for="username">User Name:</label><br>
    <input type="text" name="username" placeholder="User-Name" required><br>
    <label for="password">Password:</label><br>
    <input type="text" name="pass" placeholder="Password" required><br>
    <input type="text" name="passRepeat" placeholder="Repeat Password" required><br>
    <label for="email">E-Mail:</label><br>
    <input type="email" name="email" placeholder="E-Mail" required></input><br>
    <label for="first_name">First Name:</label><br>
    <input type="text" name="first_name" placeholder="First Name" required><br>
    <label for="last_name">Last Name:</label><br>
    <input type="text" name="last_name" placeholder="Last Name" required><br>
    <button type="submit" name="signup-submit">Signup</button>
  </fieldset>
  </form>
  <a href="reset-password.php"> Forgot your password?</a>
</main>

<?php
  require "Objects/footer.html"
 ?>
</html>
