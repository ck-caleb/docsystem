<?php
ini_set("display_errors", 0);
@include 'config.php';

session_start();

// file upload
if(isset($_POST['upload_file'])){
    $department=$_POST['department'];
    $cat=$_POST['cat'];
    $type=$_POST['type'];
    $zero='0';

    $targetDir = "uploads/"; 
    $allowTypes = array('doc','docx','dot','pdf'); 
    
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
    foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            // if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
                    //$insertValuesSQL .= "('".$fileName."','".$department."','".$cat."','".$type."','".$zero."',"; 
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            // }else{ 
            //     $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            // } 
    } 
         
    //     // Error message 
    //     $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
    //     $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
    //     $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
         
        // if(!empty($insertValuesSQL)){ 
            //$insertValuesSQL = trim($insertValuesSQL, ','); 
            // Insert image file name into database 
            $adminid=$_SESSION['admin_id'];
            $insert = $conn->query("INSERT INTO documents(document, department, category, type, status, user_uploaded) VALUES ('$fileName','$department', '$cat', '$type','1', '".$_SESSION['admin_id']."')"); 
            if($insert){ 
                ?><script>alert('Upload successful')</script><?php
            }else{ 
                ?><script>alert("Sorry, there was an error uploading your file."); </script><?php
            } 
        // }else{ 
        //     ?><script>//alert("Upload failed! ");</script><?php 
        // } 
    }else{ 
      ?><script>alert('Please select a file to upload.')</script><?php
    }
} 
// }else{
//     $id=$_POST['id'];
//     $selectid="insert into downloads(document_id) values('$id')";
//     $conn->query($selectid);

//  }

else if(!empty($_GET['file'])){
    $fileName  = basename($_GET['file']);
    $filePath  = "uploads/".$fileName;
    
    if(!empty($fileName) && file_exists($filePath)){

        //define header
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        
        //read file 
        readfile($filePath);
        
        exit;
    }
    else{
        ?><script>alert('Document not Found!')</script><?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documents</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <script src="js/bootstrap.min.js?V=<?php echo time(); ?>"></script>
    <script src="js/jquery.js?V=<?php echo time(); ?>"></script>
    <script src="js/dt.js?V=<?php echo time(); ?>"></script>
    <script src="js/dtbt.js?V=<?php echo time(); ?>"></script>

    <link rel="stylesheet" href="css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<style>
    
    .show-buttons{
        width:10%;
    }
    .userbox{
        display:flex;
    }
    .view_doc{
        width:90%;
    }
    .show-buttons button{
        width:100%;
    }
    .black-back{
        width:100%;
        height:100vh;
        background-color:#000;
        opacity:0.7;
        position:absolute;
        z-index:20;
    }
    #blurred,
    #view_downloads{
        display:none;
    }
    #adduser{
        z-index:21;
    }
#btn-close{
    width:30%;
}
#view_all{
    display:block;
}
#view_doc_back{
    display:none;
}
#view_doc_panel{
    width:70%;
    margin-left:15%;
    height:fit-content;
    padding-bottom:15px;
    z-index:53;
    background:#FFFFFF;
    border-radius:5px;
    position:absolute;
    display:none;
}
#view_all .btn, #view_downloads .btn{
            margin-right:8px;
            padding:5px;
            font-size:10px;
            margin-bottom:5px;
            cursor:pointer;
}
.view_a, .view_b{
    float:left;
    width:50%;
    text-align:left;
}
.view_a > *{
    margin-left:6%;   
}
.top h5{
    margin-left:3%;
}
.top h5{
    color:rgb(0,130,189);
    font-size:18px;
    padding:15px;
    width:fit-content;
    border-bottom:1px solid rgb(0,130,189);
}
.view_a h5,
.view_a h4,
.view_a h3,
.view_a h6{
    color:rgb(120,120,120);
    font-size:20px;
    font-weight:bold;
    margin-bottom:15px;
}
.view_a h5 span,
.view_a h4 span,
.view_a h3 span,
.view_a h6 span{
    color:rgb(0,130,189);
    font-weight:lighter;
}
.view_b button{
    background:rgb(0,130,189);
    padding:5px 7px 5px 7px;
    border:0;
    margin-bottom:15px;
    border-radius:5px;
    color:#FFFFFF;
}
</style>

<body class="admin-user">
    <div id="view_doc_back" class="black-back">

    </div>
    <!-- viewing document details -->
    <div id="view_doc_panel">
        <div class="top">
            <h5>Document Details</h5>
        </div>
        <div class="view_a">
        <h3>Name: <span id="title_view">The Doc Title</span></h3>
        <h4>Department: <span id="dep_view">Finance</span></h4>
        <h5>Category: <span id="cat_view">Financial</span></h5>
        <h6>Type: <span id="type_view">Records</span></h6>
        </div>
        <div class="view_b">
            <!-- <button>APPROVE</button> -->
            <!-- <button>REJECT</button> -->
            
        </div>
    </div>

    <div class="black-back"id="blurred">

    </div>
    
    <div class="navigation_bar">
    <ul>
        <li><a href="admin_page.php"><i class='bx bxs-home icon'></i> Dashboard</a></li>
        <li><a href="category.php"><i class="fa fa-gift" aria-hidden="true"></i>Category</a></li>
        <li><a href="type.php"><i class="fa fa-list-alt" aria-hidden="true"></i>Type</a></li>
        <li><a href="list.php"><i class="fa fa-list" aria-hidden="true"></i>List</a></li>
        <li><a href="users.php"><i class="fa fa-group" aria-hidden="true"></i>Users</a></li>
        <li><a href="dep.php"><i class="fa fa-building" aria-hidden="true"></i>Department</a></li>
        <li><a href="login_form.php"><i class="fa fa-power-off"style="color:red; font-size:24px;" aria-hidden="true"></i>logout</a></li>
                      
        
    </ul>
    </div>
    <section class="home">
        <div class="home-header">

            <div class="header-text">
                <div><span>documents</span></div>

            </div>
            <div class="user-wrapper">

                <h4><span><i class='bx bxs-user'></i><span><?php echo $_SESSION['admin_name'] ?></span></h>
            </div>

        </div>
        <div class="con">
            <div id="adduser">
                <div class="entry_box">
                    <form action="list.php" method="POST"enctype="multipart/form-data" >
                        <h3>Add Document</h3>
                        <select name="department">
                            <?php
                            
                            $select = "select * from department_data";
                            $result = $conn->query($select);
                            ?><option value=""disabled selected="true">Department</option><?php
                            while ($row= mysqli_fetch_assoc($result)) {
                            ?>
                            
                            <?php
                                 echo "<option value=".$row['department'].">".$row['department']."</option>";
                            }
                            ?>
                            
                            
                        </select> 
                        <select name="cat" id="dep">
                            <?php
                            $select = "select * from category_data";
                            $result = $conn->query($select);
                            ?>
                            <option value=""disabled selected="true">Category</option>
                            <?php
                            while ($row= mysqli_fetch_assoc($result)) {
                                 echo "<option value=".$row['name'].">".$row['name']."</option>";
                            }
                            ?>
                            
                            
                        </select> 
                        <select name="type" id="selected">

                            <!--show categories-->
                        </select>
                        <input type="file" name="files[]" id="file" multiple/> 
                        <input type="submit"class="btn btn-primary"value="Submit"name="upload_file">
                    </form>
                </div>

            </div>

        </div>
        
        


        <div class="userbox">
            <div class="view_doc">
                <div id="view_all">
            <table id="downloads" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th hidden>#</th>
                        <th>Documents</th>
                        <th>Department</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                             <?php
                            $select = "select * from documents inner join users_data on documents.user_uploaded=users_data.login_id ";
                            $result = $conn->query($select);
                            while ($row= mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td hidden><?php echo $row['id'];?></td>
                                    <td>
                                        <span style="color:rgb(0,130,189)">Document:</span><?php echo $row['document'];?>
                                        <span style="color:rgb(0,130,189)">Email:</span><?php echo $row['work_email'];?>
                                </td>
                                    <td><?php echo $row['department'];?></td>
                                    <td><?php echo $row['category'];?></td>
                                    <td><?php echo $row['type'];?></td>
                                    <td>
                                    <?php

                                        if($row['user_uploaded']=='1'){
                                            ?>
                                            <span style="color:green;margin-right:5px;">Approved</span>
                                            <?php  
                                        }else{
                                            if($row['status']=='0'){
                                                ?>
                                                <button class="btn btn-success approve">APPROVE</button>
                                                <button class="btn btn-danger reject">REJECT</button>
                                                <?php
    
                                            }else if($row['status']=='1'){
                                                ?>
                                                <span style="color:green;margin-right:5px;">Approved</span>
                                                <?php
                                            }else{
                                                ?>
                                                <span style="color:red;margin-right:5px;">Rejected</span>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td style="display:flex;flex-wrap:nowrap;">
                                   
                                    <a href="list.php?file=<?php echo $row['document'] ?>"class="btn btn-success getid">DOWNLOAD</a>
                                        <button class="btn btn-secondary btn-view-doc">VIEW</button>
                                        <button class="btn btn-danger delete_doc">DELETE</button><br>

                                        <?php
                                        if($row['user_uploaded']=='1'){
                                            //do nothing
                                        }else{
                                            ?>
                                            <!-- <button class="btn btn-secondary"style="cursor:pointer">REPLY</button> -->
                                            <?php
                                        }
                                        ?>
                                </td>
                                </tr>
                                 <?php
                            }
                            ?>
                </tbody>
            </table>
            </div>
            <div id="view_downloads">
            <table id="user_downloaded" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th hidden>#</th>
                        <th style="width:40%">Documents</th>
                        <th>Department</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Download Date</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                            $select = "select * from downloads inner join documents on documents.id=downloads.document_id";
                            $result = $conn->query($select);
                            while ($row= mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td hidden><?php echo $row['download_id'];?></td>
                                    <td style="width:40%"><?php echo $row['document'];?></td>
                                    <td><?php echo $row['department'];?></td>
                                    <td><?php echo $row['category'];?></td>
                                    <td><?php echo $row['type'];?></td>
                                    <td><?php echo $row['download_date'];?></td>
                                    <td>
                                        <button class="btn btn-success btn-view-doc">VIEW</button>
                                        <button class="btn btn-danger del_download">DELETE</button>
                                </td>
                                </tr>
                                 <?php
                            }
                            ?>
                </tbody>
                </tfoot>
            </table>
            </div>
        </div>
            <div class="show-buttons">
            <button class="btn btn-primary"id="go_docs">View</button>
            <button class="btn btn-primary"id="btn_add">Add</button>
            <!-- <button class="btn btn-primary"id="btn_add">Modify Docs</button> -->
            <!-- <button class="btn btn-primary"id="btn_add">All Docs</button> -->
            <button class="btn btn-primary"id="btn_downloads">Downloads</button>
        </div>
        </div>

    </section>

    <script src="js/bootstrap.min.js"></script>


</body>

</html>

<script src="script.js"></script>
<script>
    $(document).ready(function() {
        //$('#users').DataTable()
        //$('#downloads').DataTable()

        $('#dep').on('change', function(){
            var data=$('#dep').val()
            $.ajax({
                url:'selecteddep.php',
                method:'POST',
                data:{data:data},
                success:function(data){
                    $('#selected').html(data)
                }
            })
        })

    })
    $('.getid').on('click', function(){
        var id=$(this).closest('tr').find('td:eq(0)').text().trim()
        $.ajax({
                url:'download.php',
                method:'POST',
                data:{id:id},
                success:function(data){
                    
                }
            })
    })
    $('.approve').on('click', function(){
        var id=$(this).closest('tr').find('td:eq(0)').text().trim()
        $.ajax({
                url:'approve.php',
                method:'POST',
                data:{id:id},
                success:function(data){
                    $('#dep').html(data)
                }
            })
    })
    $('.delete_doc').on('click', function(){
        var id=$(this).closest('tr').find('td:eq(0)').text().trim()
        $.ajax({
                url:'deletedoc.php',
                method:'POST',
                data:{id:id},
                success:function(data){
                    $('#dep').html(data)
                }
            })
    })
    $('.del_download').on('click', function(){
        var id=$(this).closest('tr').find('td:eq(0)').text().trim()
        $.ajax({
                url:'deletedownload.php',
                method:'POST',
                data:{id:id},
                success:function(data){
                    $('#dep').html(data)
                }
            })
    })
    
    $('.reject').on('click', function(){
        var id=$(this).closest('tr').find('td:eq(0)').text().trim()
        $.ajax({
                url:'reject.php',
                method:'POST',
                data:{id:id},
                success:function(data){
                    $('#dep').html(data)
                }
            })
    })
    $('.btn-view-doc').on('click', function(){
        document.getElementById('view_doc_back').style.display='block'
        document.getElementById('view_doc_panel').style.display='block'
        
        // getting data tables
        var row=$(this).closest('tr')
        var title=row.find('td:eq(1)').text().trim()
        var dep=row.find('td:eq(2)').text().trim()
        var cat=row.find('td:eq(3)').text().trim()
        var type=row.find('td:eq(4)').text().trim()

        // displaying
        $('#row').html(row)
            $('#title_view').html(title)
            $('#dep_view').html(dep)
            $('#cat_view').html(cat)
            $('#type_view').html(type)

    })
    $('#view_doc_back').on('click', function(){
        document.getElementById('view_doc_back').style.display='none'
        document.getElementById('view_doc_panel').style.display='none'
    })
    
    document.getElementById('btn_add').onclick = function() {
        var getuserform = document.getElementById('adduser');
        // getuserform.style.display='block';
        if (getuserform.style.display = 'none') {
            getuserform.style.display = 'block'
            document.getElementById('blurred').style.display='block'
        }

    }
    
    document.getElementById('blurred').onclick = function() {
        var getuserform = document.getElementById('adduser');
        if (getuserform.style.display = 'block') {
            getuserform.style.display = 'none'
            document.getElementById('blurred').style.display='none'
        }

    }
    document.getElementById('go_docs').onclick=function(){
        document.getElementById('view_downloads').style.display='none'
        document.getElementById('view_all').style.display='block'
    }
    document.getElementById('btn_downloads').onclick=function(){
        document.getElementById('view_downloads').style.display='block'
        document.getElementById('view_all').style.display='none'
    }
    // downloads
        $('#downloads').DataTable()
        $('#user_downloaded').DataTable()

</script>