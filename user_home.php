<?php
ini_set("display_errors", 0);
@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sidebar</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>



<body class="admin-user">
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
                        <a href="#">
                            <i class='bx bxs-home icon'></i>
                            <span class="text nav-text" id="btn-home">Dashboard</span>


                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="docs.php">
                            <i class='bx bxs-home icon'></i>
                            <span class="text nav-text" id="btn-home">Documents</span>


                        </a>
                    </li>
                    <!-- <div id="to-show">
                        <span id="show-child" class="text"><i class='bx bxs-edit icon'></i>Manage document</span>
                        <span id="hide-child" class="text"><i class='bx bxs-edit icon'></i>Manage documents</span>
                        <div id="child-content">
                            <li><a href="category.php" class="text">document category</a></li>
                            <li><a href="type.php" class="text">document type</a></li>
                            <li><a href="list.php" class="text">documents</a></li>
                        </div>
                    </div> -->


                    <!-- <li class="nav-link">
                        <a href="org.php">
                            <i class='bx bxs-buildings icon'></i>
                            <!-- <span class="text nav-text" id="btn-org">Organisation</span> ->



                        </a>
                    </li> -->


                    <li class="nav-link">
                        <!-- <a href="dep.php">
                            <i class='bx bxs-building icon'></i>
                            <span class="text nav-text" id='depid'>Department</span>
                        </a>
                    </li> -->
                    <!-- <li class="nav-link">
                        <a href="users.php">
                            <i class='bx bxs-user icon'></i>
                            <span class="text nav-text">users</span>
                        </a>
                    </li> -->
                </ul>
            </div>
            <div class="bottom-content">
                <li class="">
                    <a href="login_form.php" class="btn">
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
                <div><span>Dashboard</span></div>

            </div>
            <div class="user-wrapper">

                <h4><span><i class='bx bxs-user'></i><span><?php echo $_SESSION['admin_name'] ?></span></h>
                        <small>admin</small>

            </div>

        </div>
        <!-- =========dashboard====== -->
        <div class="card" id="carde">
            <div class="card1">
                <p>Documents</p>
                <img src="docpicture.png" alt="">
            </div>
            <div class="card2">
                <p>Categories</p>
                <img src="categpicture.png" alt="">
            </div>
            <div class="card3">
                <p>Department</p>
                <img src="deppicture.png" alt="">

            </div>
        </div>
    </section>
    <script src="script.js">
    </script>

</body>

</html>