<?php
    $servername = "localhost";
    $username = "root";
    $password = "" ;
    $dbname = "stockdb1";

    $conn = new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error)
    {
       die("Connection Failed: " . $conn->connect_error);
    }
    else
    {
        // echo "Connection Successfull";
    }

?>