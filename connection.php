<?php  
    $conn= new mysqli('localhost', 'root', '' ,'student');
    if(!$conn){
        die("Connection failed".$conn->connect_error);
    }
    ?>