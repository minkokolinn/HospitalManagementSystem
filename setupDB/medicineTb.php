<?php
include("../connect.php");
$drop = "DROP table medicine";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped medicine</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table medicine
            (
                medicineId int not null AUTO_INCREMENT,
                medicineName varchar(200),
                medicineImg varchar(100),
                size varchar(255),
                madein varchar(100),
                ingredient text,
                price int,
                quantity int,
                description text,
                PRIMARY KEY (medicineId)
            )";
$runcreate = $connection->query($create);

if ($runcreate) {
    echo "<p>Successfully created medicine</p>";
} else {
    echo $connection->error;
}

?>


