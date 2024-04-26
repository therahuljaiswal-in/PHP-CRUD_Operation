<?php
include 'connection.php'; // Include your database connection file
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>CRUD OPERATION</title>
    <style>
        .h1{
              color: #4cbd06;
              margin-left: 35%;
          }
          #updatebutton{
            margin-left:21px;
          }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <h2 class="h1">PHP CRUD OPERATION</h2>
        <div class="collapse navbar-collapse" id="navbarNav"></div>
    </div>
</nav>
<div class="container my-5">
    <!-- New button -->
    <div class="text-front mb-3">
        <a href="index.php" class="btn btn-success"> + Add New</a>
    </div>
    <div class="container my-5">
        <table id="mytable" class="table">
            <thead>
            <tr>
                <th>NAME</th>
                <th>CLASS</th>
                <th>SECTION</th>
                <th>ROLL NO.</th>
                <th>COUNTRY</th>
                <th>OPERATIONS</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // delete logic
            if(isset($_GET['deleteid'])){
                $ID=$_GET['deleteid'];
                            $sql="DELETE FROM students where ID=$ID";
               $result=mysqli_query($conn,$sql);
              if($result) {
                 header('location:display.php');
              } else{
                 die(mysqli_error($conn));
              }
             }
                 // fetch data from database
            $sql = "SELECT * FROM students";
            $result = mysqli_query($conn, $sql); // Run SQL query for retrieving
                        if (!$result) {
                die("Error: " . mysqli_error($conn)); // Check for errors in query execution
            }
            while ($row = mysqli_fetch_assoc($result)) {
                $ID = $row['ID']; // Get the ID from the row
                $Name = $row['Name'];
                $Class = $row['Class'];
                $Section = $row['Section'];
                $Roll = $row['Roll'];
                $Country = $row['Country'];
                echo '
<tr>
    <td>' . $Name . '</td>
    <td>' . $Class . '</td>
    <td>' . $Section . '</td>
    <td>' . $Roll . '</td>
    <td>' . $Country . '</td>
    <td>
    <a href="index.php?updateid=' . $ID . '"><i id="updatebutton" class="material-icons">mode_edit</i></a>
        <a href="#" onclick="confirmDelete(' . $ID . ')"><i id="deletebutton" class="fa fa-trash-o" style="font-size:26px " ></i></a>
    </td>
</tr> ';            }            ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#mytable').DataTable({
            "searching": true,
            "columnDefs": [
                { "orderable": false, "targets": -1 } // Disable sorting for the last column (OPERATIONS)
            ]
        });
    });
    function confirmDelete(ID) {
        if (confirm("Are you sure you want to delete this record?")) {
            window.location.href = 'display.php?deleteid=' + ID;
        }
    }
</script>
</body>
</html>
