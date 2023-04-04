<?php
ini_set("display_errors", 0);
@include 'config.php';
@include 'logout.php';

session_start();

if (isset($_POST['submit'])) {
   $email = $_POST['email'];
   $password = md5($_POST['password']);
   $result = $conn->query("select * from user_form where email='$email' and password='$password' ");
   $rowcount = mysqli_num_rows($result);
   if ($rowcount < 1) {
      $error[] = 'incorrect email or password!';
   } else {
      $thedata = mysqli_fetch_assoc($result);
      $_SESSION['user_name'] = $thedata['name'];

      if ($thedata['user_type'] == 'admin') {
         $_SESSION['admin_id'] = $thedata['id'];
         $_SESSION['unique_id'] = $row['id'];
         header('Location:admin_page.php');
      } else if ($thedata['user_type'] == 'user') {
         echo $_SESSION['client_id'] = $thedata['id'];
         $_SESSION['unique_id'] = $row['id'];
         header('Location:user/admin_page.php');
      }
   }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<style>

</style>

<body>

   <div class="form-container">
      <div class="project-name">
         <h1>document management system</h1>
      </div>

      <form action="" method="post" autocomplete="off">
         <h3>login now</h3>
         <?php
         if (isset($error)) {
            foreach ($error as $error) {
               echo '<span class="error-msg">' . $error . '</span>';
            };
         };
         ?>
         <input type="email" name="email" required placeholder="enter your email" autocomplete="on">
         <input type="password" name="password" required placeholder="enter your password">
         <input type="submit" name="submit" value="login now" class="form-btn">
         <p>don't have an account? <a href="register_form.php">register now</a></p>
         <a href="passwordreset.php">Forgot password?</a>
      </form>
   </div>
</body>

</html>