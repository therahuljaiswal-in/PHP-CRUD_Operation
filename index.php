<?php
include("connection.php");
// Initialize variables to track update status and insertion visibility
$updateInProgress = false;
$insertButtonVisible = true;
// Variables to store updating details
$updateID = '';
$updateName = '';
$updateClass = '';
$updateSection = '';
$updateRoll = '';
$updateCountry = '';
// Check if an update is in progress
if (isset($_GET['updateid'])) {
    $updateInProgress = true;
    $insertButtonVisible = false; // Hide the Insert button when Update is in progress
    // Fetch existing data for the updating record
    $updateID = mysqli_real_escape_string($conn, $_GET['updateid']);
    $result = mysqli_query($conn, "SELECT * FROM students WHERE ID = $updateID");
    if ($result && $row = mysqli_fetch_assoc($result)) {
        $updateName = $row['Name'];
        $updateClass = $row['Class'];
        $updateSection = $row['Section'];
        $updateRoll= $row['Roll'];
        $updateCountry= $row['Country'];
    } else {
        die(mysqli_error($conn));
    }
}
// Handle form submissions
if (isset($_POST['submit_insert'])) {
    $Name = $_POST['name'];
    $Class = $_POST['class'];
    $Section = $_POST['section'];
    $Roll = $_POST['roll'];
    $Country = $_POST['country'];
        $sql = "INSERT INTO students (name, class, section, roll, country) 
            VALUES ('$Name', '$Class', '$Section', '$Roll', '$Country')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Data inserted successfully";
        header('location:display.php');
        exit;
    } else {
        die(mysqli_error($conn));
    }
} elseif (isset($_POST['submit_update'])) {
    $ID = mysqli_real_escape_string($conn, $_GET['updateid']);
    $Name = mysqli_real_escape_string($conn, $_POST['name']);
    $Class = mysqli_real_escape_string($conn, $_POST['class']);
    $Section = mysqli_real_escape_string($conn, $_POST['section']);
    $Roll = mysqli_real_escape_string($conn, $_POST['roll']);
    $Country = mysqli_real_escape_string($conn, $_POST['country']);

    $sql = "UPDATE students SET id=$ID, name='$Name', class='$Class', section='$Section', roll='$Roll', country='$Country' WHERE ID=$ID";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('location:display.php');
        exit;
    } else {
        die(mysqli_error($conn));
    }
}
?>
<!DOCTYPE html>
<html>
<head>
 <title>CRUD</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <style>
      .h1{
          color: #4cbd06;
          margin-left: 35%;
      }
      .container-fluid1{
        margin-top: 3.5%;
        margin-left: 30px;
        width: 55%;
      }      
  </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <!-- <a class="navbar-brand" href="index.php">PHP CRUD OPERATION</a> -->
        <h2 class="h1">PHP CRUD OPERATION</h2>
         <div class="collapse navbar-collapse" id="navbarNav">
        </div>
      </div>
    </nav>
    <div class="container-fluid1">
    <form method="post">
  <div class="mb-2">
    <label>Name</label>
    <input type="text" class="form-control" id="Name" name="name" placeholder="Enter your name" required autocomplete="off" value="<?php echo $updateInProgress ? $updateName : ''; ?>">
  </div>
  <div class="mb-2">
    <label>Class</label>
    <input type="text" class="form-control" id="Class" name="class" placeholder="Enter your class" required autocomplete="off" value="<?php echo $updateInProgress ? $updateClass : ''; ?>">
  </div>
  <div class="mb-2">
    <label>Section</label>
    <input type="text" class="form-control" id="Section" name="section" placeholder="Enter your section" required autocomplete="off" value="<?php echo $updateInProgress ? $updateSection : ''; ?>">
  </div>
  <div class="mb-2">
    <label>Roll No.</label>
    <input type="text" class="form-control" id="Roll" name="roll" placeholder="Enter your roll no." required autocomplete="off" value="<?php echo $updateInProgress ? $updateRoll : ''; ?>">
  </div>
  <div class="mb-2">
    <label>Country</label>
    <input type="text" class="form-control" id="Country" name="country" placeholder="Enter your country" required autocomplete="off" value="<?php echo $updateInProgress ? $updateCountry : ''; ?>">
  </div>
        <?php if ($insertButtonVisible): ?>
            <button type="submit" name="submit_insert" class="btn btn-primary">
                <i class="bi bi-plus-square"></i> Submit
            </button><br>
        <?php endif; ?>
        <!-- Show the Update button only when an update is in progress -->
        <?php if ($updateInProgress): ?>
            <button type="submit" name="submit_update" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Update
            </button>
        <?php endif; ?>
    </form>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>