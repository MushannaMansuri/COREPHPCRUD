<?php
require "config.php";

// Delete
$id = $_GET["id"];
$dlt = mysqli_query($connection, "DELETE FROM tbl_student WHERE `id`= '$id'") or die(mysqli_error($connection));
if ($dlt) {
    echo "<script>alert('Successfully Record Deleted');window.location='index.php';</script>";
} else {
    echo "<div class='alert alert-danger'>Sorry</div>";
}
?>