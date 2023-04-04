<?php
ini_set("display_errors", 0);
@include 'config.php';
$name = $_POST['data'];

$result = $conn->query("select * from type_data where category_name='$name'");
$row = mysqli_num_rows($result);
if ($row < 1) {
    echo "<option disabled selected='true'>No Type Found!</option>";
} else {
    while ($thedata = mysqli_fetch_assoc($result)) {
        echo "<option value" . $thedata['name'] . ">" . $thedata['name'] . "</option>";
    }
}
