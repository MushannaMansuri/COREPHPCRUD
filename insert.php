<?php
require "config.php";

// Insert
if (isset($_POST['submit'])) {
  $name = ($_POST['name']);
  $gender = ($_POST['gender']);
  $marks = ($_POST['marks']);
  $check = (isset($_POST['check']) ? implode('|', $_POST['check']) : '');
  $location = ($_POST['location']);
// print_r($check);exit();
  $filename = $_FILES["file"]["name"];
  $tempname = $_FILES["file"]["tmp_name"];
  $folder = "uploads/" . $filename;
  //print_r($filename);exit;
  if (!empty($check && $name && $gender && $location && $marks && $folder)) {

    if (move_uploaded_file($tempname, $folder)) {

      $ins = mysqli_query($connection, "INSERT INTO tbl_student(`name`, `gender`, `marks`, `checkbox`, `location`, `img`) VALUES('$name', '$gender', '$marks', '$check', '$location', '$folder')") or die(mysqli_error($connection));
    }

    if ($ins) {
      echo "<script>alert('Successfully Record Inserted');window.location='index.php';</script>";
    } else {
      echo "<script>alert('Error');</script>";
    }

  } else {
    echo "<script>alert('Please Fill all the Fields');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insert Data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

</head>

<body>
  <form class="mt-3 mx-3" action="insert.php" method="post" enctype="multipart/form-data">
    <h2>Student Info</h2>

    <!-- Name -->
    <div class="mb-3">
      <label for="name" class="form-label">Name:</label>
      <input type="text" class="form-control" id="" name="name" maxlength="50"  required> <?php //echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>
    </div>

    <!-- Gender -->
    <div class="form-gender mt-3">
      <input class="form-check-input" type="radio" name="gender" id="gender" value="Male" required>
      <label class="form-check-label" for="gender">
        Male
      </label>
    </div>
    <div class="form-gender mb-3">
      <input class="form-check-input" type="radio" name="gender" id="gender" value="Female" required>
      <label class="form-check-label" for="gender">
        Female
      </label>
    </div>

    <!-- Marks -->
    <div class="mb-3">
      <label for="marks" class="form-label">Marks:</label>
      <input type="number" class="form-control" id="exampleInputEmail1" name="marks" required>
    </div>

    <!-- Image -->
    <div class="mb-3">
      <label for="marks" class="form-label">Image:</label>
      <input type="file" name="file" required />
    </div>

    <!-- Checkbox -->
    <div class="form-group required mb-3">
      <input type="checkbox" name="check[]" value="Hindi"> Hindi <br>
      <input type="checkbox" name="check[]" value="English"> English <br>
      <input type="checkbox" name="check[]" value="Gujarati"> Gujarati <br>
    </div>

    <!-- SelectBox -->
    <select class="form-select mb-3" name="location" aria-label="Default select example" required>
      <option value="">Location</option>
      <option value="ahmedabad">Ahmedabad</option>
      <option value="surat">Surat</option>
      <option value="vadodra">Vadodra</option>
    </select>

    <!-- Buttons -->
    <button type="button" onclick="window.location='index.php';" class="btn btn-primary mt-3">View</button>
    <button type="reset" name="submit" class="btn btn-danger mt-3">RESET</button>
    <button type="submit" name="submit" class="btn btn-success mt-3">SUBMIT</button>
  </form>

</body>

</html>