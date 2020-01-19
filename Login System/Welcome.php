<DOCTYPE html>
<html>
<?php
  session_start();
  require "Objects/nav.html"
 ?>
<main>
  <div>
  <?php
    if(isset($_SESSION['userId'])){
      $userName = $_SESSION['userId'];
      echo '<p class="login-status">'.$userName.',You are logged in.</p>';
      echo '<form action="Includes/logout.Con.php" method="POST">
      <button type="submit" name="logout-submit">Logout</button></form>';

    } else {
      echo '<p class="login-status">You are logged out.</p>';
    }
  ?>
  </div>
</main>

<?php
  require "Objects/footer.html"
 ?>


</html>
