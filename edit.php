<?php
require "config.php";

if (isset($_POST["submit"])) {
    $id = $_GET["id"]; // Retrieve the ID from the URL
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $marks = $_POST['marks'];
    $location = $_POST['location'];
    $check = isset($_POST['check']) ? implode('|', $_POST['check']) : '';

    $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = "uploads/" . $filename;

    if (!empty($check && $name && $gender && $location && $marks && $folder)) {

        if (move_uploaded_file($tempname, $folder)){
        $updtimg = mysqli_query($connection, "UPDATE `tbl_student` SET  `img`= '$folder'  WHERE `tbl_student`.`id` = $id") or die (mysqli_error($connection));
        }

        $updt = mysqli_query($connection, "UPDATE `tbl_student` SET `name`= '$name', `gender`= '$gender', `marks`= '$marks', `location`= '$location', `checkbox`= '$check'  WHERE `tbl_student`.`id` = $id") or die(mysqli_error($connection));
        if ($updtimg) {
            echo "<script>alert('Successfully Image Updated');window.location='index.php';</script>";

        } else if($updt){
            echo "<script>alert('Successfully Record Updated');window.location='index.php';</script>";
            
        }else{
            echo "<script>alert('Upadate any value otherwise click on View button');</script>";

        }
    }
    else{
    echo "<script>alert('Please dont blanck any fields, all fields are Reqired');</script>";
    }
   
}

// Fetch data
$id = $_GET["id"];
$query = mysqli_query($connection, "SELECT * FROM tbl_student WHERE id = $id") or die (mysqli_error($connection));
$row = mysqli_fetch_array($query);
// print_r($row);exit;
if ($row) {
    // $id= $row['id'];
    $name = $row['name'];
    $gender = $row['gender'];
    $marks = $row['marks'];
    $location = $row['location'];
    $img = $row['img'];
    // print_r($img);exit;
    $check = explode('|', $row['checkbox']);  
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


        <h2>Student Info</h2>

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
        </div>

        <!-- Gender -->
        <div class="form-gender mt-3">
            <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male"
                <?php if ($gender === "Male") echo "checked"; ?> required>
            <label class="form-check-label" for="genderMale">Male</label>
        </div>
        <div class="form-gender mb-3">
            <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female"
                <?php if ($gender === "Female") echo "checked"; ?> required>
            <label class="form-check-label" for="genderFemale">Female</label>
        </div>

        <!-- Marks -->
        <div class="mb-3">
            <label for="marks" class="form-label">Marks:</label>
            <input type="number" class="form-control" id="marks" name="marks" value="<?php echo $marks; ?>" required>
        </div>

        <!-- CheckBox -->
        <div class="form-group mb-3">
            <input type="checkbox" name="check[]" value="Hindi" <?php if (in_array("Hindi", $check)) echo "checked"; ?>>
            Hindi<br>
            <input type="checkbox" name="check[]" value="English"
                <?php if (in_array("English", $check)) echo "checked"; ?>> English<br>
            <input type="checkbox" name="check[]" value="Gujarati"
                <?php if (in_array("Gujarati", $check)) echo "checked"; ?>> Gujarati <br>
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label for="marks" class="form-label">Image:</label>
            <?php if ($img): ?>
            <img src="<?php echo $img; ?>" width="55" height="55" alt="Image Preview">
            <input type="file" name="file">
            <?php else: ?>
            <input type="file" name="file" required>
            <?php endif; ?>
        </div>


        <!-- SelectBox -->
        <select class="form-select mb-3" name="location" aria-label="Default select example" required>
            <option value="">Location</option>
            <option value="ahmedabad" <?php if ($location == "ahmedabad") echo "selected"; ?>>Ahmedabad</option>
            <option value="surat" <?php if ($location == "surat") echo "selected"; ?>>Surat</option>
            <option value="vadodra" <?php if ($location == "vadodra") echo "selected"; ?>>Vadodra</option>
        </select>

        <!-- Buttons -->
        <button type="button" onclick="window.location='index.php';" class="btn btn-primary mt-3">View</button>
        <button type="submit" name="submit" class="btn btn-success mt-3" value="Update">UPDATE</button>
    </form>
</body>

</html>