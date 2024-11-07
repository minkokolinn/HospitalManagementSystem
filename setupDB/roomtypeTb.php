<?php
include("../connect.php");
$drop = "DROP table roomtype";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped roomtype</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table roomtype
            (
                rtId int not null AUTO_INCREMENT,
                rtName varchar(50),
                rtSize int,
                rtRate int,
                rtImg varchar(50),
                rtFaci text,
                PRIMARY KEY(rtId)
            )";
$runcreate = $connection->query($create);

if ($runcreate) {
    echo "<p>Successfully created room type</p>";
} else {
    echo $connection->error;
}