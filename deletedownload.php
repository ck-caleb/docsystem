<?php
ini_set("display_errors", 0);
@include 'config.php';
$id = $_POST['id'];
$conn->query("delete from downloads where download_id='$id' ");
?>
<script>
    location.href = "list.php"
</script>