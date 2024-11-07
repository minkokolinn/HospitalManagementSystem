<?php
include("../connect.php");
$drop = "DROP table ordermedicine";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped ordermedicine</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table ordermedicine
            (
                ordermedicineId int not null AUTO_INCREMENT,
                orderId int,
                medicineId int,
                quantity int,
                PRIMARY KEY(ordermedicineId),
                FOREIGN KEY(orderId) REFERENCES ordermed(orderId),
                FOREIGN KEY(medicineId) REFERENCES medicine(medicineId)
            )";
$runcreate = $connection->query($create);

if ($runcreate) {
    echo "<p>Successfully created ordermedicine</p>";
} else {
    echo $connection->error;
}

?>