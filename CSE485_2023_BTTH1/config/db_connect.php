<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "btth01_cse485";

    $conn = mysqli_connect($host, $user, $password, $database);

    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
?> 