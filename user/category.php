<?php
ini_set("display_errors", 0);
@include 'config.php';

session_start();
$_SESSION['del']='Delete';

if (!isset($_SESSION['admin_name'])) {
    header('location:login_form.php');
}
if (isset($_POST['apply_category'])) {
    $textname = $_POST['namecategory'];
    //$textdate = $_POST['datecategory'];
    $textdescription = $_POST['descriptioncategory'];
    $insert = "INSERT INTO category_data(name, description) VALUES( '$textname','$textdescription')";
    if($rs = mysqli_query($conn, $insert)){
        echo "<script>alert('records inserted successfully');</script>";
    }else{
        echo "<script>alert('Failed');</script>";
    }
}else if (isset($_POST['update_cat'])) {
    $textname = $_POST['namecategory'];
    $id=$_POST['hidden_id'];
    //$textdate = $_POST['datecategory'];
    $textdescription = $_POST['descriptioncategory'];
    $insert = "update category_data set name='$textname', description='$textdescription' where category_id='$id'";
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
    <title>Category| User</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <script src="../js/bootstrap.min.js?V=<?php echo time(); ?>"></script>
    <script src="../js/jquery.js?V=<?php echo time(); ?>"></script>
    <script src="../js/dt.js?V=<?php echo time(); ?>"></script>
    <script src="js/dtbt.js?V=<?php echo time(); ?>"></script>

    <link rel="stylesheet" href="../css/bootstrap.min.css?v=<?php echo time(); ?>">
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
        <li><a href="list.php"><i class="fa fa-list" aria-hidden="true"></i>List</a></li>
        <li><a href="../login_form.php"><i class="fa fa-power-off"style="color:red; font-size:24px;" aria-hidden="true"></i></a></li>
                
        
    </ul>
    </div>
    <section class="home">
        <div class="home-header">

            <div class="header-text">
                <div><span>category</span></div>

            </div>
            <div class="user-wrapper">

                <h4><span><i class='bx bxs-user'></i><span><?php echo $_SESSION['admin_name'] ?></span></h>

            </div>

        </div>
        <style>
            #shown{
                display:block;
            }
            #hidden{
                display:none;
            }
        </style>
        <div class="con">
            <div id="adduser">
                <div class="entry_box">
                    <form action="category.php" method="POST"autocomplete="off">
                        <h3>Category details</h3>
                        <input type="hidden"id="hidden_id"name="hidden_id">
                        <input type="text" id="namecategory" name="namecategory" placeholder="enter  category name">
                        <!--input type="date" id="date created" name="datecategory" placeholder="enter date created"-->
                        <textarea name="descriptioncategory" id="txtdescription" cols="30" rows="10"placeholder="Describe category"></textarea><br>
                        <input type="submit" style="width:fit-content;margin-left:0%;"name="apply_category"class="btn btn-primary"value="Submit"id="shown">
                        <input type="submit" name="update_cat"class="btn btn-primary"value="Update"id="hidden">
                    </form>
                </div>

            </div>

        </div>
        <div class="userbox">

            <div class="btn btn-primary" id="btn_add">CREATE</div>
            <div id="userss1"></div>

            <table id="category" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th hidden>#</th>
                        <th>Name</th>
                        <th>Date created</th>
                        <th>Description</th>
                        <th>action</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select = "select * from category_data";
                    $result = $conn->query($select);
                    while ($rowcount = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                        <td hidden><?php echo $rowcount['category_id']; ?></td>

                            <td><?php echo $rowcount['name']; ?></td>
                            <td><?php echo $rowcount['date_created']; ?></td>
                            <td><?php echo $rowcount['description']; ?></td>
                            <td style="display:flex;flex-wrap:nowrap;">
                                <button class="btn btn-danger del"style="margin-right:5px">delete</button>
                                <button class="btn btn-info update">edit</button>
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
        // $('#users').DataTable();
        $('#category').DataTable();
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
            document.getElementById('shown').style.display='block'
            document.getElementById('hidden').style.display='none'
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
        }
    }
    $('.update').on('click', function(){
        var id=$(this).closest('tr').find('td:eq(0)').text().trim()
        var cat=$(this).closest('tr').find('td:eq(1)').text().trim()
        var des=$(this).closest('tr').find('td:eq(3)').text().trim()
        var getuserform = document.getElementById('adduser');
        var back=document.getElementById('blurr-back')
        // getuserform.style.display='block';
        if (getuserform.style.display = 'none') {
            getuserform.style.display = 'block'
            back.style.display='block';
            document.body.scrollTo(0,0)
            document.body.style.overflow='hidden'
            document.getElementById('hidden_id').value=id
            document.getElementById('namecategory').value=cat
            document.getElementById('txtdescription').value=des
            document.getElementById('shown').style.display='none'
            document.getElementById('hidden').style.display='block'
        }
    })
</script>