<?php
ini_set("display_errors", 0);
@include 'config.php';
session_start();
session_start();
if (isset($_POST['btn_send'])) {
  $email = $_POST['email'];
  $message = $_POST['message'];
  $conn->query("update messages set email ='$email' , reply='$message'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home| User</title>
  <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
  <script src="../js/bootstrap.min.js?V=<?php echo time(); ?>"></script>
  <script src="../js/jquery.js?V=<?php echo time(); ?>"></script>
  <script src="../js/dt.js?V=<?php echo time(); ?>"></script>
  <script src="../js/dtbt.js?V=<?php echo time(); ?>"></script>

  <link rel="stylesheet" href="../css/bootstrap.min.css?v=<?php echo time(); ?>">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="admin-user">
  <div class="navigation_bar">
    <ul>
      <li><a href="admin_page.php"><i class='bx bxs-home icon'></i> Dashboard</a></li>
      <li><a href="list.php"><i class="fa fa-list" aria-hidden="true"></i>List</a></li>
      <li><a href="message.php"><i class="fa fa-list" aria-hidden="true"></i>Messages</a></li>
      <li><a href="../login_form.php"><i class="fa fa-power-off" style="color:red; font-size:24px;" aria-hidden="true"></i></a></li>
    </ul>
  </div>
  <section class="home">
    <div class="home-header">
      <div class="header-text">
        <div><span class="ledashboard">Dashboard</span></div>
      </div>
      <div class="user-wrapper">
        <h4><span><i class='bx bxs-user'></i><span><?php echo $_SESSION['admin_name'] ?></span></h>
      </div>
    </div>
    <!-- =========dashboard====== -->
    <style>
      .message_box {
        margin-top: 50px;
        margin-left: 15%;
        border: 1px solid black;
      }

      .message_panel {
        display: flex;
      }
    </style>
    <div class="message_panel">
      <div class="message_box">
        <form action="message.php" method="POST">
          <select name="email" id="dep">
            <?php
            $select = "select * from users_data";
            $result = $conn->query($select);
            ?>
            <option value="" disabled selected="true">To</option>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value=" . $row['work_email'] . ">" . $row['work_email'] . "</option>";
            }
            ?>
          </select><br>
          <textarea name="message" id="" cols="30" rows="10" placeholder="Enter Message"></textarea>
          <input type="submit" class="btn btn-success" value="Send" name="btn_send">
        </form>
      </div>
      <div class="chat_box">
        <?php
        $result = $conn->query("select * from messages");
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <div class="inbox">
            <p><?php echo $row['messages']; ?></p>
          </div>
          <div class="outbox">
            <p><?php echo $row['reply']; ?></p>
          </div>
        <?php
        }
        ?>
      </div>
      <style>
        .chat_box {
          margin-top: 3rem;
          margin-left: 2rem;
          border: 1px solid black;
          padding: 20px;
          border-radius: 5px;
          box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
          background: #fff;
          text-align: center;
          width: 500px;
        }
      </style>
    </div>
  </section>
  <script src="script.js">
  </script>

</body>

</html>


<script>
  /*drop down*/
  document.getElementById('show-child').onclick = function() {
    const getchild = document.getElementById('child-content')
    const hide = document.getElementById('hide-child')
    const toshow = document.getElementById('show-child')
    if (getchild.style.display = 'none') {
      getchild.style.display = 'block'
      toshow.style.display = 'none'
      hide.style.display = 'block'
    } else {
      //do nothing
    }
  }
  document.getElementById('hide-child').onclick = function() {
    const getchild = document.getElementById('child-content')
    const show = document.getElementById('show-child')
    const tohide = document.getElementById('hide-child')
    if (getchild.style.display = 'block') {
      getchild.style.display = 'none'
      show.style.display = 'block'
      tohide.style.display = 'none'
    } else {
      //do nothing
    }
  }
  // ===finish dropdown====
  document.getElementById('btn-org').onclick = function() {
    const dash = document.getElementById('carde')
    const organ = document.getElementById('org-panel')
    const department = document.getElementById('deppanel')

    if (dash.style.display = 'block') {
      dash.style.display = 'none'
      organ.style.display = 'block'
      department.style.display = 'none'
    } else {
      //do nothing
    }
  }
  document.getElementById('depid').onclick = function() {
    const dash = document.getElementById('carde')
    const department = document.getElementById('deppanel')
    const organ = document.getElementById('org-panel')
    if (department.style.display = 'none') {
      dash.style.display = 'none'
      department.style.display = 'block'
      organ.style.display = 'none'
    } else {
      //do nothing
    }
  }
</script>