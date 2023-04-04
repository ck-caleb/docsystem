<?php
ini_set("display_errors", 0);
@include 'config.php';
$conn->query("update documents set status ='2' where id=" . $_POST['id'] . "");
?>
<script>
    location.href = "list.php"
</script>