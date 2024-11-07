<?php
include("../connect.php");
$drop = "DROP table bookingservice";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped bookingservice</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table bookingservice
            (
                bsId int not null AUTO_INCREMENT,
                userId int not null,
                serviceId int not null,
                bookingCode varchar(100) not null,
                operationDate date not null,
                operationTime time not null,
                noofPatient int not null,
                estimatedCost int not null,
                bookingNote text,
                investigationResult varchar(100),
                status boolean,
                PRIMARY KEY (bsId),
                FOREIGN KEY (userId) REFERENCES user(userId),
                FOREIGN KEY (serviceId) REFERENCES service(serviceId)
            )";
$runcreate = $connection->query($create);


if ($runcreate) {
    echo "<p>Successfully created bookingservice</p>";
} else {
    echo $connection->error;
}
