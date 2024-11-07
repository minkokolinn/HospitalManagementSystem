<?php
include("../connect.php");
$drop = "DROP table appointment";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped appointment</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table appointment
            (
                appointmentId int not null AUTO_INCREMENT,
                userId int,
                doctorId int,
                appt_date date,
                appt_stime time,
                appt_etime time,
                phoneNumber varchar(15),
                yourMessage text,
                PRIMARY KEY(appointmentId), 
                FOREIGN KEY(userId) REFERENCES user(userId),
                FOREIGN KEY(doctorId) REFERENCES doctor(doctorId)
            )";
$runcreate = $connection->query($create);

if ($runcreate) {
    echo "<p>Successfully created appointment</p>";
} else {
    echo $connection->error;
}

?>