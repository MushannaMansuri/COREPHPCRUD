<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>


</head>

<body>

  <div class="container">
    <a href="insert.php">
      <button type="button" class="btn btn-primary mt-3">Add Student Info</button>
    </a>

    <!-- Table -->
    <table class="table mt-3" style="text-align: center;">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Gender</th>
          <th scope="col">Marks</th>
          <th scope="col">Language</th>
          <th scope="col">Location</th>
          <th scope="col">img</th>
          <th scope="col">Action</th>
          <!-- <th scope="col">Edit</th> -->
        </tr>
      </thead>
      <tbody>

        <?php
        // Read
        require "config.php";

        $read = mysqli_query($connection, "SELECT * FROM tbl_student") or die(mysqli_error($connection));
        $i = 0;
        if (mysqli_num_rows($read) > 0) {
          while ($row = mysqli_fetch_array($read)) {
            $i++;
            $id = $row['id'];
            $name = $row['name'];
            $gender = $row['gender'];
            $marks = $row['marks'];
            $check = $row['checkbox'];
            $location = $row['location'];
            $img = $row['img'];

            ?>

            <tr>

              <td>
                <?php echo $i; ?>
              </td>
              <td>
                <?php echo ucfirst(strtolower($name)); ?>
              </td>
              <td>
                <?php echo $gender; ?>
              </td>
              <td>
                <?php echo $marks; ?>
              </td>
              <td>
                <?php echo $check ?>
              </td>
              <td>
                <?php echo ucfirst($location) ?>
              </td>
              <td>
                <img src="<?php echo $img; ?>" width="55" height="55">
              </td>
              <td>
                <a href="edit.php?id=<?php echo $id; ?>" class="btn btn-outline-primary"><img src="img/editicon.png"
                    style="width: 18px;"></a> | 
                <!-- <a href="editimg.php?id=<?php //echo $id; ?>" class="btn btn-outline-warning"><img src="img/imgediticon.png"
                  style="width: 20px;"></a> -->
                <a href="delete.php?id=<?php echo $id; ?>" class="btn btn-outline-danger"><img src="img/dlticon.png"
                    style="width: 18px;"></a>
              </td>
              <!-- <td>
            <a href="delete.php?id=<?php //echo $id; ?>" class="btn btn-outline-danger"><img src="img/dlticon.png" style="width: 16px;"></a>
          </td> -->
            </tr>
            <?php
          }
        } else {
          echo "<tr><td colspan='12'>No records found</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>