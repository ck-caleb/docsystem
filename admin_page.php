<?php
ini_set("display_errors", 0);

@include 'config.php';

session_start()
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
  <script src="js/bootstrap.min.js?V=<?php echo time(); ?>"></script>
  <script src="js/jquery.js?V=<?php echo time(); ?>"></script>
  <script src="js/dt.js?V=<?php echo time(); ?>"></script>
  <script src="js/dtbt.js?V=<?php echo time(); ?>"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css?v=<?php echo time(); ?>">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="admin-user">
  <div class="navigation_bar">
    <ul>
      <li><a href="admin_page.php"><i class='bx bxs-home icon'></i> Dashboard</a></li>
      <li><a href="category.php"><i class="fa fa-gift" aria-hidden="true"></i>Category</a></li>
      <li><a href="type.php"><i class="fa fa-list-alt" aria-hidden="true"></i>Type</a></li>
      <li><a href="list.php"><i class="fa fa-list" aria-hidden="true"></i>List</a></li>
      <li><a href="users.php"><i class="fa fa-group" aria-hidden="true"></i>Users</a></li>
      <li><a href="dep.php"><i class="fa fa-building" aria-hidden="true"></i>Department</a></li>
      <li><a href="message.php"><i class="fa fa-box" aria-hidden="true"></i>Messages</a></li>
      <li><a href="login_form.php"><i class="fa fa-power-off" style="color:red; font-size:24px;" aria-hidden="true"></i>logout</a></li>
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
    <div class="card_home" id="carde">
      <div class="card1">
        <?php
        $doc = $conn->query("select * from documents");
        $docount = mysqli_num_rows($doc);
        ?>
        <p>Documents </p>
        <p><?php echo $docount; ?></p>
        <i class="fa fa-file" aria-hidden="true"></i>
      </div>
      <div class="card2">
        <p>Categories</p>
        <?php
        $doc = $conn->query("select * from category_data");
        $docount = mysqli_num_rows($doc);
        ?>
        <p><?php echo $docount; ?></p>
        <i class="fa fa-list-alt" aria-hidden="true"></i>
      </div>
      <div class="card3">
        <p>Department</p>

        <?php
        $doc = $conn->query("select * from department_data");
        $docount = mysqli_num_rows($doc);
        ?>
        <p><?php echo $docount; ?></p>
        <i class="fa fa-building" aria-hidden="true"></i>
      </div>
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