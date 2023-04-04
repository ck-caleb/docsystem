<?php
ini_set("display_errors", 0);
session_start();
@include 'config.php';
$email = $_SESSION['otp_email'];
if (isset($_POST['password_reset_link'])) {
   $opt = $_POST['otp'];
   $pass = $_POST['pass'];
   $conpass = $_POST['conpass'];
   if ($pass != $conpass) {
?><script>
         alert('Passwords do not match!')
      </script><?php
            } else {
               $conotp = $conn->query("select * from pass_reset where email='$email' and otp='$opt'");
               $res = mysqli_num_rows($conotp);
               if ($res < 1) {
               ?><script>
            alert('Check OTP')
         </script><?php
               } else {
                  $newpass = md5($pass);
                  $conn->query("update user_form set password='$newpass' where email='$email' ");
                  ?><script>
            alert('Password Change')
         </script><?php
               }
            }
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

      <form action="changepass.php" method="post">
         <h3>reset password </h3>
         <?php
         ?>
         <input type="text" name="otp" required placeholder="Enter OTP">
         <input type="password" name="pass" required placeholder="New Password">
         <input type="password" name="conpass" required placeholder="Confirm Password">
         <input type="submit" name="password_reset_link" value="Change" class="form-btn-admin">
      </form>
   </div>
</body>

</html>