<DOCTYPE html>
<html>


<?php
  session_start();
  require "Objects/nav.html"
 ?>
<main>
  <div>
  <?php
    if(isset($_SESSION['username'])){
      echo '<p class="login-status">You are logged in.</p>';
      echo '<form action="includes/logout.Con.php" method="POST">
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
