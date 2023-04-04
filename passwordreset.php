<!-- script links -->
<script src="js/jquery.js?V=<?php echo time(); ?>"></script>
<?php
ini_set("display_errors", 0);
session_start();
@include 'config.php';

if (isset($_POST['btn_reset'])) {
    $email = $_POST['email'];
    $confirmqry = "select * from user_form where email='$email'limit 1";
    $result = $conn->query($confirmqry);
    $count = mysqli_num_rows($result);
    if ($count < 1) {
?><script>
            alert('The Email is Not Registered!')
        </script><?php
                } else {
                    $num = rand(100, 1000);
                    ?>
        <script>
            var email = <?php echo json_encode($email); ?>;
            $.ajax({
                method: 'POST',
                url: 'https://formsubmit.co/ajax/' + email + '',
                dataType: 'json',
                accepts: 'application/json',
                data: {
                    OTP: <?php echo json_encode($num); ?>
                },
                success: (data) => console.log(data),
                error: (err) => console.log(err)
            });
        </script>
<?php
                    $conn->query("insert into pass_reset(email,otp) values('$email','$num')");
                    $_SESSION['otp_email'] = $email;
                    header('Location:changepass.php');
                }
            }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<style>
    body {
        background-color: rgb(240, 240, 240);
    }

    .get_email {
        width: 40%;
        margin-top: 150px;
        margin-left: 30%;
        background-color: rgb(150, 150, 150);
        border-radius: 10px;
        padding-bottom: 20px;
    }

    .get_email p {
        margin-left: 3%;
        padding-top: 15px;
    }

    .get_email input[type=text] {
        height: 35px;
        padding-left: 5px;
        font-size: 16px;
        border: 0;
        border-radius: 4px;
        width: 60%;
        margin-left: 3%;
    }

    .get_email input[type=submit] {
        background-color: red;
        border: 0;
        margin-left: 10px;
        height: 35px;
        color: #FFFFFF;
        border-radius: 3px;
        width: 20%;
        font-size: 15px;
        cursor: pointer;
    }
</style>

<body>
    <div class="get_email">
        <p>A reset code will be send to your email?</p>
        <form action="passwordreset.php" method="POST">
            <input type="text" name="email" placeholder="Enter Your Email" required>
            <input type="submit" value="Send" name="btn_reset">
        </form>
    </div>
</body>

</html>