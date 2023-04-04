<?php
ini_set("display_errors", 0);
$id = $_POST['column'];
include 'config.php';


$sql = "DELETE FROM type_data WHERE type_id='$id'";
if (mysqli_query($conn, $sql)) {

?>
    <script>
        alert('Deleted')
        location.href = 'type.php'
    </script>
<?php

} else {
?><script>
        alert('Error delete record!')
    </script><?php
            }
                ?>