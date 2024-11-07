<?php
include("../connect.php");
$drop = "DROP table room";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped room</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table room
            (
                roomId int not null AUTO_INCREMENT,
                roomNumber varchar(10),
                roomNote text,
                bookedStatus boolean,
                wardId int,
                rtId int,
                PRIMARY KEY (roomId),
                FOREIGN KEY(wardId) REFERENCES ward(wardId),
                FOREIGN KEY(rtId) REFERENCES roomtype(rtId)
            )";
$runcreate = $connection->query($create);

if ($runcreate) {
    echo "<p>Successfully created room</p>";
} else {
    echo $connection->error;
}
