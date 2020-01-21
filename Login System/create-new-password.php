<!DOCTYPE html>
<html>
<head>

</head>
<?php
  require "Objects/nav.html"
?>
<main>
  <?php
    $selector = $_GET["selector"];
    $validator = $_GET["validator"];
    if (empty($selector) || empty(validator)){
      echo "Could not validate your request!";
    }else {
      if (ctype_xdigit($selector)!== false && ctype_xdigit($validator) !==false){
          ?>
          <form action="Includes/reset-password.Con.php" method="POST">
            <input type="hidden" name="selector" value="<?php echo $selector; ?>">
            <input type="hidden" name="validator" value="<?php echo $validator; ?>">
            <input type="password" name="password" placeholder="Enter a new password...">
            <input type="password" name="password-repeat" placeholder="Repeat new password...">
            <button type="submit" name="reset-password-submit">Reset Password</button>
          </form>
        <?php
      }
    }

   ?>
</main>

<?php
  require "Objects/footer.html"
 ?>
</html>
