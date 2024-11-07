<?php
include("../connect.php");
$drop = "DROP table ward";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped ward</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table ward
            (
                wardId int not null AUTO_INCREMENT,
                wardName varchar(100) not null,
                PRIMARY KEY (wardId)
            )";
$runcreate = $connection->query($create);

if ($runcreate) {
    echo "<p>Successfully created ward</p>";
} else {
    echo $connection->error;
}
