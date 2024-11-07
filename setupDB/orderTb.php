<?php
include("../connect.php");
$drop = "DROP table ordermed";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped order</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table ordermed
            (
                orderId int not null AUTO_INCREMENT,
                userId int,
                orderDate date,
                deliveryMethod varchar(10),
                total int,
                deliveredStatus boolean,
                PRIMARY KEY(orderId),
                FOREIGN KEY(userId) REFERENCES user(userId)
            )";
$runcreate = $connection->query($create);

if ($runcreate) {
    echo "<p>Successfully created order</p>";
} else {
    echo $connection->error;
}

?>