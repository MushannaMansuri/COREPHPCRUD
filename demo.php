<?php
// CONNECTION
$host = "localhost";
$username = "root";
$password = "";
$db = "dbname";

$connection = mysqli_connect($host, $username, $password, $db);

require "config.php";
// INSERT
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $marks = $_POST['marks'];

    $qry = "INSERT INTO tbl_student(`name`,`gender`,`marks`) VALUES ('$name','$gender','$marks')";
    if (mysqli_query($connection, $qry)) {
        echo "<div>Record added</div>";

    }

}

// VIEW
$qry = "SELECT * FROM tbl_student";
if ($view = $connection->query($qry)) {

    while ($row = $view->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['name'];
        $gender = $row['gender'];
        $marks = $row['marks'];
    }

}

// DELETE
$id = $_GET['id'];
$dlt = "DELETE FROM tbl_name WHERE id ='$id'";
if (mysqli_query($connection, $dlt)) {
    echo "record deleted";
}

?>