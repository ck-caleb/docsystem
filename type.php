<?php
ini_set("display_errors", 0);
@include 'config.php';
$_SESSION['del'] = 'Delete';

session_start();
if (isset($_POST['apply_type'])) {
    $textname = $_POST['nametype'];
    // $textdat = $_POST['datetype'];
    // $textmodified = $_POST['datemodifiedtype'];
    $category=$_POST['category'];
    $insert = "INSERT INTO type_data( name,category_name) VALUES( '$textname','$category')";
    if($rs = mysqli_query($conn, $insert)){
        echo "<script>alert('records inserted successfully');</script>";
    }else{
        echo "<script>alert('Failed');</script>";
    }
    
}else if (isset($_POST['update_type'])) {
    $textname = $_POST['nametype'];
    $id=$_POST['hidden_id'];
    // $textdat = $_POST['datetype'];
    // $textmodified = $_POST['datemodifiedtype'];
    $category=$_POST['category'];
    $insert = "update type_data set name='$textname', category_name='$category' where type_id='$id' ";
    if($rs = mysqli_query($conn, $insert)){
        echo "<script>alert('Updated');</script>";
    }else{
        echo "<script>alert('Failed');</script>";
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Type</title>
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
    <section class="home">
        <div class="home-header">

            <div class="header-text">
                <div><span>Document type</span></div>

            </div>
            <div class="user-wrapper">

                <h4><span><i class='bx bxs-user'></i><span><?php echo $_SESSION['admin_name'] ?></span></h>

            </div>

        </div>
        <div class="con">
            <style>
                #shown{
                    display:block;
                }
                #hidden{
                    display:none;
                }
            </style>
            <div id="adduser">
                <div class="entry_box">
                    <form action="type.php" method="POST">
                        <h3>Document Details</h3>
                        <input type="hidden"name="hidden_id"id="hidden_id">
                        <input type="text" id="nametype" name="nametype" placeholder="name">
                            <?php
                                $result=$conn->query("select * from category_data");
                            ?>
                        <select name="category" id=""required>
                            <option value=""disabled selected="true">Category</option>
                            <?php
                            while($rowcount=mysqli_fetch_assoc($result)){
                            echo "<option value=".$rowcount['name'].">".$rowcount['name']."</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" class="btn btn-info"name="apply_type"value="Submit"id="shown">
                        <input type="submit" class="btn btn-info"name="update_type"value="Update"id="hidden">
                    </form>
                </div>
            </div>
        </div>
        <div class="userbox">
            <div class="btn btn-primary" id="btn_add">NEW TYPE</div>
            <div id="userss2"></div>
            <!--div class="btn btn-primary" id="btn_create">Create</div-->
            <table id="type" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th hidden>#</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Date Created</th>
                        <th>Last Modified</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select = "select * from type_data";
                    $result = $conn->query($select);
                    while ($rowcount = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td hidden><?php echo $rowcount['type_id']; ?></td>

                            <td><?php echo $rowcount['name']; ?></td>
                            <td><?php echo $rowcount['category_name']; ?></td>
                            <td><?php echo $rowcount['date_created']; ?></td>
                            <td><?php echo $rowcount['date_modified']; ?></td>
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
</body>
</html>
<script>
    $(document).ready(function() {
        $('#type').DataTable();
    })
</script>
<script src="script.js">
</script>
<script>
    document.getElementById('btn_add').onclick = function() {
        const getuserform = document.getElementById('adduser');
        const back=document.getElementById('blurr-back')
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
        const getuserform = document.getElementById('adduser');
        const back=document.getElementById('blurr-back')
        if (getuserform.style.display = 'none') {
            getuserform.style.display = 'none'
            document.body.style.overflow='scroll'
            back.style.display='none'
            document.getElementById('shown').style.display='block'
            document.getElementById('hidden').style.display='none'
        }

    }
    $('.update').on('click', function(){ 
       const id=$(this).closest('tr').find('td:eq(0)').text().trim()
       const name=$(this).closest('tr').find('td:eq(1)').text().trim()
        const getuserform = document.getElementById('adduser');
        const back=document.getElementById('blurr-back')
        // getuserform.style.display='block';
        if (getuserform.style.display = 'none') {
            getuserform.style.display = 'block'
            back.style.display='block';
            document.body.scrollTo(0,0)
            document.body.style.overflow='hidden'
            document.getElementById('nametype').value=name;
            document.getElementById('hidden_id').value=id
            document.getElementById('shown').style.display='none'
            document.getElementById('hidden').style.display='block'
        }
    })
</script>