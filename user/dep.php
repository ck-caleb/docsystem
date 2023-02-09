<?php
ini_set("display_errors", 0);
@include 'config.php';

session_start();
$_SESSION['del']='Delete';

if (!isset($_SESSION['admin_name'])) {
    header('location:login_form.php');
}

if (isset($_POST['apply_department'])) {
    $textdepartment = $_POST['department_table'];

    $insert = "INSERT INTO department_data( department) VALUES( '$textdepartment')";
    $rs = mysqli_query($conn, $insert);

    echo "<script>alert('records inserted successfully');</script>";
}else if(isset($_POST['update_dep'])){
$textdepartment = $_POST['department_table'];
$id=$_POST['hidden_id'];
    $insert = "update department_data set department='$textdepartment' where department_id='$id'";
    $rs = mysqli_query($conn, $insert);

    echo "<script>alert('Updated');</script>";
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
        <li><a href="login_form.php"><i class="fa fa-power-off"style="color:red; font-size:24px;" aria-hidden="true"></i></a></li>
                      
        
    </ul>
    </div>
    <style>
           #shown{
            display:block;
           } 
           #hidden{
            display:none;
           }
        </style>
    <section class="home">
        <div class="home-header">
            <div class="header-text">
                <div><span>Department</span></div>


            </div>
            <div class="user-wrapper">
                <h4><span><i class='bx bxs-user'></i><span><?php echo $_SESSION['admin_name'] ?></span></h4>
                

            </div>

        </div>
       
        <div class="con">
            <div id="adduser">
                <div class="entry_box">
                    <form action="dep.php" method="POST">
                        <h3>Department Details</h3>
                        <!-- <label for="department">department</label> -->

                        <input type="text" name="department_table"id="department_table" placeholder="enter department name">
                        <input type="hidden"id="hidden_id"name="hidden_id">
                        <input type="submit" name="apply_department"value="Submit"class="btn btn-primary"id="shown">
                        <input type="submit" name="update_dep"value="Update"class="btn btn-primary"id="hidden">
                        <!-- <button  name="apply_department">Submit</button> -->

                    </form>
                </div>

            </div>

        </div>

        <div class="userbox">

            <div class="btn btn-primary" id="btn_add">NEW DEPT</div>
            <div id="userss3"></div>
            <table id="dep" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th hidden>#</th>
                        <th>Department</th>
                        <th>action</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select = "select * from department_data";
                    $result = $conn->query($select);
                    while ($rowcount = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td hidden><?php echo $rowcount['department_id']; ?></td>
                            <td><?php echo $rowcount['department']; ?></td>

                            <td><a href="#" class="btn btn-danger del">DELETE</a>
                                <a href="#" class="btn btn-info update">UPDATE</a>
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
        $('#dep').DataTable();
    })
</script>

<script src="script.js">
</script>
<script>
    document.getElementById('btn_add').onclick = function() {
        var getuserform = document.getElementById('adduser');
        var back=document.getElementById('blurr-back')
        // getuserform.style.display='block';
        if (getuserform.style.display = 'none') {
            getuserform.style.display = 'block'
            back.style.display='block';
            document.body.scrollTo(0,0)
            document.body.style.overflow='hidden'
        }

    }
</script>
<script>
    document.getElementById('blurr-back').onclick = function() {
        var getuserform = document.getElementById('adduser');
        var back=document.getElementById('blurr-back')
        if (getuserform.style.display = 'none') {
            getuserform.style.display = 'none'
            document.body.style.overflow='scroll'
            back.style.display='none'
            document.getElementById('shown').style.display='block'
            document.getElementById('hidden').style.display='none'
        }
    }
    $('.update').on('click', function(){
        var name=$(this).closest('tr').find('td:eq(1)').text().trim()
        var id=$(this).closest('tr').find('td:eq(0)').text().trim()
        var getuserform = document.getElementById('adduser');
        var back=document.getElementById('blurr-back')
        // getuserform.style.display='block';
        if (getuserform.style.display = 'none') {
            getuserform.style.display = 'block'
            back.style.display='block';
            document.body.scrollTo(0,0)
            document.body.style.overflow='hidden'
            document.getElementById('hidden_id').value=id
            document.getElementById('department_table').value=name
            document.getElementById('shown').style.display='none'
            document.getElementById('hidden').style.display='block'
        }
    })
</script>