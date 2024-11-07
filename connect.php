<?php
    $host="localhost";
    $username="root";
    $password="admin";
    $dbname="hms_db";

    $connection=new mysqli($host,$username,$password,$dbname);
    if ($connection->connect_error) {
        die("Connection failed");
    }
    // echo "Successfully connected...";
    
?>
