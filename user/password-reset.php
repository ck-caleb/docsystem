<?php

ini_set("display_errors", 0);
@include 'config.php';

if(isset($_SESSION['status'])){
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
      // if(isset($error)){
      //    foreach($error as $error){
      //       echo '<span class="error-msg">'.$error.'</span>';
      //    };
      // };
      ?>
    <!-- <input type="text" name="name" required placeholder="enter your name"> -->
      <input type="email" name="email" required placeholder="enter your email">
      <!-- <input type="password" name="password" required placeholder="enter your password"> -->
      <!-- <input type="password" name="cpassword" required placeholder="confirm your password"> -->
      
      <input type="submit" name="password_reset_link" value="send password reset link" class="form-btn-admin">
      <!-- <p>already have an account? <a href="adminlogin_form.php">login now</a></p> -->
       
</form>
</div>   
</body>
</html>