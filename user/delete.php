<?php
ini_set("display_errors", 0);
$id=$_POST['column'];
include 'config.php';


$sql="DELETE FROM users_data WHERE users_id='$id'";
if (mysqli_query($conn,$sql)){
    
    ?>
    <script>
    alert('Deleted')
    location.href='users.php'
    </script>
    <?php

}else{
    ?><script>alert('Error delete record!')</script><?php
}
?>



