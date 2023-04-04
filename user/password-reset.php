<?php

ini_set("display_errors", 0);
@include 'config.php';
if (isset($_SESSION['status'])) {
?>
   <div class="success">
      <h5> $_SESSION['status']</h5>
   </div>
<?php
   unset($_SESSION['status']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin register</title>
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <div class="form-container-admin">
      <form action="password-reset-code.php" method="post">
         <h3>reset password </h3>
         <?php
         ?>
         <input type="email" name="email" required placeholder="enter your email">
         <input type="submit" name="password_reset_link" value="send password reset link" class="form-btn-admin">
      </form>
   </div>
</body>

</html>