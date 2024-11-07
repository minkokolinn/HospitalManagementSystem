<?php
include("../connect.php");
$drop = "DROP table doctor";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped doctor</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table doctor
            (
                doctorId int not null AUTO_INCREMENT,
                doctorName varchar(30) not null,
                doctorEmail varchar(50) not null UNIQUE,
                doctorPassword text not null,
                doctorPhone varchar(15),
                education text,
                introduction text,
                specialityId int,
                PRIMARY KEY (doctorId),
                FOREIGN KEY (specialityId) REFERENCES speciality(specialityId)
            )";
$runcreate = $connection->query($create);

if ($runcreate) {
    echo "<p>Successfully created doctor</p>";
} else {
    echo $connection->error;
}
