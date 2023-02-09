<?php
ini_set("display_errors", 0);
@include 'config.php';
    $id=$_POST['id'];
    $selectid="insert into downloads(document_id) values('$id')";
    $conn->query($selectid);