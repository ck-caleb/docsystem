<?php
ini_set("display_errors", 0);
include 'config.php';

session_start();
$_SESSION['del'] = 'Delete';
if (isset($_POST['btn_reg_user'])) {
    $textfirst = $_POST['firstname_user'];
    $textlast = $_POST['lastname_user'];
    $textemail = $_POST['work_email_user'];
    $textphone = $_POST['phone_user'];
    $textgender = $_POST['selgender'];
    $depname = $_POST['depname'];

    $confirmqry = "select * from users_data where work_email='$textemail' and phone='$textphone' ";
    $conresult = $conn->query($confirmqry);
    $rowcount = mysqli_num_rows($conresult);
    if ($rowcount > 0) {
        echo "<script>alert('User Already Exists!')</script>";
    } else {
        $insert = "INSERT INTO users_data( firstName, lastName, work_email, phone, Gender, department) VALUES( '$textfirst','$textlast','$textemail','$textphone', '$textgender', '$depname')";
        if (mysqli_query($conn, $insert)) {
            echo "<script>alert('User registration successful');</script>";
        } else {
            echo "<script>alert('Failed!');</script>";
        }
    }
} else if (isset($_POST['btn_update_user'])) {
    $textfirst = $_POST['firstname_user'];
    $textlast = $_POST['lastname_user'];
    $textemail = $_POST['work_email_user'];
    $textphone = $_POST['phone_user'];
    $textgender = $_POST['selgender'];
    $depname = $_POST['depname'];
    $id = $_POST['hidden_id'];
    $insert = "update users_data set firstName='$textfirst', lastName='$textlast', work_email='$textemail', phone='$textphone', Gender='$textgender', department='$depname' where users_id='$id'";
    if (mysqli_query($conn, $insert)) {
        echo "<script>alert('Updated');</script>";
    } else {
        echo "<script>alert('Failed!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <script src="js/bootstrap.min.js?V=<?php echo time(); ?>"></script>
    <script src="js/jquery.js?V=<?php echo time(); ?>"></script>
    <script src="js/dt.js?V=<?php echo time(); ?>"></script>
    <script src="js/dtbt.js?V=<?php echo time(); ?>"></script>

    <link rel="stylesheet" href="css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/del.js"></script>
</head>

<body class="admin-user">
    <div id="blurr-back">
    </div>
    <div class="navigation_bar">
        <ul>
            <li><a href="admin_page.php"><i class='bx bxs-home icon'></i> Dashboard</a></li>
            <li><a href="category.php"><i class="fa fa-gift" aria-hidden="true"></i>Category</a></li>
            <li><a href="type.php"><i class="fa fa-list-alt" aria-hidden="true"></i>Type</a></li>
            <li><a href="list.php"><i class="fa fa-list" aria-hidden="true"></i>List</a></li>
            <li><a href="users.php"><i class="fa fa-group" aria-hidden="true"></i>Users</a></li>
            <li><a href="dep.php"><i class="fa fa-building" aria-hidden="true"></i>Department</a></li>
            <li><a href="login_form.php"><i class="fa fa-power-off" style="color:red; font-size:24px;" aria-hidden="true"></i></a></li>
        </ul>
    </div>
    <section class="home">
        <div class="home-header">
            <div class="header-text">
                <div><span>users</span></div>
            </div>
            <div class="user-wrapper">
                <h4><span><i class='bx bxs-user'></i><span><?php echo $_SESSION['admin_name'] ?></span></h4>
            </div>
        </div>
        <style>
            #shown {
                display: block;
            }

            #hidden {
                display: none;
            }
        </style>
        <div class="con">
            <div id="adduser">
                <div class="entry_box">
                    <form action="users.php" method="POST" autocomplete="off">
                        <h3 id="result">User details</h3>
                        <input type="text" id="firstname" name="firstname_user" placeholder="enter firstname" required>
                        <input type="text" id="lastname" name="lastname_user" placeholder="enter lastname" required>
                        <input type="text" id="work_email" name="work_email_user" placeholder="enter work email" required>
                        <input type="number" id="phone" name="phone_user" placeholder="enter phone" required>
                        <input type="hidden" id="hidden_id" name="hidden_id">
                        <select name="selgender" id="" required>
                            <option disabled selected="true">Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <select name="depname" id="">
                            <?php
                            $getdep = $conn->query("select * from department_data");
                            ?>
                            <option value="" disabled selected="true">Department</option>
                            <?php
                            while ($deprow = mysqli_fetch_assoc($getdep)) {
                                echo "<option value=" . $deprow['department'] . ">" . $deprow['department'] . "</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" name="btn_reg_user" class="btn btn-primary" value="Submit" id="shown">
                        <input type="submit" name="btn_update_user" class="btn btn-primary" value="Update" id="hidden">
                    </form>
                </div>
            </div>
        </div>
        <div class="userbox">
            <div class="btn btn-primary" id="btn_add">NEW EMPLOYEE</div>
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
                                <a href="#" class="btn btn-info update">edit</a>
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
            document.getElementById('shown').style.display = 'block'
            document.getElementById('hidden').style.display = 'none'
        }

    }
    $('.update').on('click', function() {
        const id = $(this).closest('tr').find('td:eq(0)').text().trim();
        const fname = $(this).closest('tr').find('td:eq(1)').text().trim();
        const lname = $(this).closest('tr').find('td:eq(2)').text().trim();
        const email = $(this).closest('tr').find('td:eq(3)').text().trim();
        const phone = $(this).closest('tr').find('td:eq(4)').text().trim();
        const getuserform = document.getElementById('adduser');
        const back = document.getElementById('blurr-back')
        // getuserform.style.display='block';
        if (getuserform.style.display = 'none') {
            getuserform.style.display = 'block'
            back.style.display = 'block';
            document.body.scrollTo(0, 0)
            document.body.style.overflow = 'hidden'
            document.getElementById('hidden_id').value = id
            document.getElementById('firstname').value = fname
            document.getElementById('lastname').value = lname;
            document.getElementById('work_email').value = email
            document.getElementById('phone').value = phone
            document.getElementById('shown').style.display = 'none'
            document.getElementById('hidden').style.display = 'block'
        }
    })
</script>