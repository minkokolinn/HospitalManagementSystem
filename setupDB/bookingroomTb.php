<?php
include("../connect.php");
$drop = "DROP table bookingroom";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped bookingroom</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table bookingroom
            (
                brId int not null AUTO_INCREMENT,
                userId int,
                bookingCode varchar(100),
                useDate date,
                roomId int,
                reqInfo varchar(5),
                PRIMARY KEY (brId),
                FOREIGN KEY(userId) REFERENCES user(userId),
                FOREIGN KEY(roomId) REFERENCES room(roomId)
            )";
$runcreate = $connection->query($create);

if ($runcreate) {
    echo "<p>Successfully created bookingroom</p>";
} else {
    echo $connection->error;
}
