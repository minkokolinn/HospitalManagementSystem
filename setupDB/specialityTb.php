<?php
include("../connect.php");
$drop = "DROP table speciality";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped speciality</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table speciality
            (
                specialityId int not null AUTO_INCREMENT,
                speciality varchar(200),
                description text,
                PRIMARY KEY(specialityId)
            )";
$runcreate = $connection->query($create);

if ($runcreate) {
    echo "<p>Successfully created speciality</p>";
} else {
    echo $connection->error;
}

?>