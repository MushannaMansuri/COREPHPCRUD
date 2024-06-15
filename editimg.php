<?php
require "config.php";

if (isset($_POST["submit"])) {
    $id = $_GET["id"]; // Retrieve the ID from the URL
    $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = "uploads/" . $filename;
    // print_r($fileupload);exit;

    if (move_uploaded_file($tempname, $folder))
        $updt = mysqli_query($connection, "UPDATE `tbl_student` SET `img`= '$folder' WHERE `tbl_student`.`id` = $id") or die(mysqli_error($connection));
    if ($updt) {
        echo "<script>alert('Successfully Image Updated');window.location='index.php';</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</head>

<body>
    <form class="mt-3 mx-3" action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php //$row['id'] ?>">

        <!-- Image -->
        <div class="mb-3">
            <label for="marks" class="form-label">Image:</label>
            <input type="file" name="file" value="" <?php ?> required />
        </div>

        <button type="button" onclick="window.location='index.php';" class="btn btn-primary mt-3">View</button>
        <button type="submit" name="submit" class="btn btn-success mt-3" value="Update">UPDATE</button>
    </form>
</body>

</html>