<?php
ini_set("display_errors", 0);
$id = $_POST['column'];
include 'config.php';


$sql = "DELETE FROM category_data WHERE category_id='$id'";
if (mysqli_query($conn, $sql)) {

?>
    <script>
        alert('Deleted')
        location.href = 'category.php'
    </script>
<?php

} else {
?><script>
        alert('Error delete record!')
    </script><?php
            }
                ?>