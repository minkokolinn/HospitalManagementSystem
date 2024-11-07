<?php
include("../connect.php");
$drop = "DROP table schedule";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped schedule</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table schedule
            (
                scheduleId int not null AUTO_INCREMENT,
                dayOfSchedule ENUM('sun', 'mon', 'tue', 'wed', 'thur', 'fri', 'sat'),
                startTime time,
                endTime time,
                doctorId int,
                PRIMARY KEY(scheduleId),
                FOREIGN KEY(doctorId) REFERENCES doctor(doctorId)
            )";
$runcreate = $connection->query($create);

if ($runcreate) {
    echo "<p>Successfully created schedule</p>";
} else {
    echo $connection->error;
}
