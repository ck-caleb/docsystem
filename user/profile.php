<?php
ini_set("display_errors", 0);
include 'config.php';

session_start();
$_SESSION['del'] = 'Delete';


if (!isset($_SESSION['admin_name'])) {
    header('location:login_form.php');
}

if (isset($_POST['btn_reg_user'])) {
    $textfirst = $_POST['firstname_user'];
    $textlast = $_POST['lastname_user'];
    $textemail = $_POST['work_email_user'];
    $textphone = $_POST['phone_user'];
    $textgender = $_POST['selgender'];

    $confirmqry = "select * from users_data where work_email='$textemail' and phone='$textphone' ";
    $conresult = $conn->query($confirmqry);
    $rowcount = mysqli_num_rows($conresult);
    if ($rowcount > 0) {
        echo "<script>alert('User Already Exists!')</script>";
    } else {
        $insert = "INSERT INTO users_data( firstName, lastName, work_email, phone, Gender) VALUES( '$textfirst','$textlast','$textemail','$textphone', '$textgender')";
        if (mysqli_query($conn, $insert)) {
            echo "<script>alert('User registration successful');</script>";
        } else {
            echo "<script>alert('Failed!');</script>";
        }
    }
}
?>
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sidebar</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <script src="js/bootstrap.min.js?V=<?php echo time(); ?>"></script>
    <script src="js/jquery.js?V=<?php echo time(); ?>"></script>
    <script src="js/dt.js?V=<?php echo time(); ?>"></script>
    <script src="js/dtbt.js?V=<?php echo time(); ?>"></script>
    <script src="js/del.js"></script>

    <link rel="stylesheet" href="css/bootstrap.min.css?v=<?php echo time(); ?>">


    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body class="admin-user">
    <div id="blurr-back">
    </div>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="icon-top">
                    <i class='bx bx-folder-open'></i>

                </span>
                <div class="text header-text">
                    <span class="name">Document manager</span>

                </div>

            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <li class="search-box">

                    <i class='bx bx-search icon'></i>
                    <input type="search" placeholder="search">

                </li>
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="admin_page.php">
                            <i class='bx bxs-home icon'></i>
                            <span class="text nav-text" id="btn-home">Dashboard</span>
                        </a>
                    </li>
                    <div id="to-show">
                        <li><span id="show-child" class="text"><i class='bx bxs-edit icon'></i>Manage document</span></li>
                        <span id="hide-child" class="text"><i class='bx bxs-edit icon'></i>Manage documents</span>
                        <div id="child-content">
                            <li><a href="category.php" class="text">document category</a></li>
                            <li><a href="type.php" class="text">document type</a></li>
                            <li><a href="list.php" class="text">documents</a></li>
                        </div>
                    </div>
                    <li class="nav-link">
                        <a href="dep.php">
                            <i class='bx bxs-building icon'></i>
                            <span class="text nav-text" id='depid'>Department</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bxs-user icon'></i>
                            <span class="text nav-text ">users</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bottom-content">
                <li class="">
                    <a href="adminlogin_form.php" class="btn">
                        <i class='bx bx-left-arrow-alt icon'></i>
                        <span class="text nav-text">logout</span>
                    </a>
                </li>
                <li class="mode">
                    <div class="moon-sun">
                        <i class='bx bxs-moon moon'></i>
                        <i class='bx bxs-sun sun'></i>

                    </div>
                    <span class="mode-text text">Dark Mode</span>

                    <div class="toggle-switch">
                        <span class="switch">.</span>
                    </div>

                </li>

            </div>
        </div>
    </nav>
    <section class="home">
        <div class="home-header">
            <div class="header-text">
                <div><span>users</span></div>


            </div>
            <div class="user-wrapper">
                <h4><span><i class='bx bxs-user'></i><span><?php echo $_SESSION['admin_name'] ?></span></h4>
                <small>admin</small>

            </div>

        </div>
        <div class="con">
            <div id="adduser">
                <div class="entry_box">
                    <form action="users.php" method="POST" autocomplete="off">
                        <h3 id="result">User details</h3>

                        <input type="text" id="firstname" name="firstname_user" placeholder="enter firstname" required>
                        <input type="text" id="lastname" name="lastname_user" placeholder="enter lastname" required>
                        <input type="text" id="work_email" name="work_email_user" placeholder="enter work email" required>
                        <input type="number" id="phone" name="phone_user" placeholder="enter phone" required>
                        <select name="selgender" id="" required>
                            <option disabled selected="true">Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <input type="submit" name="btn_reg_user" class="btn btn-primary" value="Submit">
                    </form>
                </div>

            </div>

        </div>
        <div class="userbox">

            <div class="btn btn-primary" id="btn_add">NEW USER</div>
            <div id="userss"></div>
            <table id="users" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th hidden>#</th>
                        <th>firstame</th>
                        <th>lastname</th>
                        <th>work_email</th>
                        <th>phone</th>
                        <th>gender</th>
                        <th>action</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    $select = "select * from users_data";
                    $result = $conn->query($select);
                    while ($rowcount = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td hidden><?php echo $rowcount['users_id']; ?></td>
                            <td><?php echo $rowcount['firstName']; ?></td>
                            <td><?php echo $rowcount['lastName']; ?></td>
                            <td><?php echo $rowcount['work_email']; ?></td>
                            <td><?php echo $rowcount['phone']; ?></td>
                            <td><?php echo $rowcount['Gender']; ?></td>
                            <td><a href="#" class="btn btn-danger del">delete</a>
                                <a href="" class="btn btn-info">edit</a>
                            </td>
                        </tr>
                    <?php

                    }
                    ?>

                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>



    </section>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>

<script>
    $(document).ready(function() {
        $('#users').DataTable();


    })
</script>

<script src="script.js">
</script>
<script>
    document.getElementById('btn_add').onclick = function() {
        const getuserform = document.getElementById('adduser');
        const back = document.getElementById('blurr-back')
        // getuserform.style.display='block';
        if (getuserform.style.display = 'none') {
            getuserform.style.display = 'block'
            back.style.display = 'block';
            document.body.scrollTo(0, 0)
            document.body.style.overflow = 'hidden'
        }
    }
</script>
<script>
    document.getElementById('blurr-back').onclick = function() {
        const getuserform = document.getElementById('adduser');
        const back = document.getElementById('blurr-back')
        if (getuserform.style.display = 'none') {
            getuserform.style.display = 'none'
            document.body.style.overflow = 'scroll'
            back.style.display = 'none'
        }

    }
</script>