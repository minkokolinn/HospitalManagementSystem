<?php
include("../connect.php");
$drop = "DROP table staff";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped staff</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table staff
            (
                staffId int not null AUTO_INCREMENT,
                staffName varchar(30) not null,
                staffEmail varchar(50) not null UNIQUE,
                staffPassword text not null,
                staffPhone varchar(15),
                staffAddress text,
                reqStatus boolean,
                PRIMARY KEY (staffId)
            )";
$runcreate = $connection->query($create);

if ($runcreate) {
    echo "<p>Successfully created staff</p>";
} else {
    echo $connection->error;
}

$insert = "INSERT into staff(staffName,staffEmail,staffPassword,staffPhone,staffAddress,reqStatus) values
            ('Mg Mg','mgmg@gmail.com','" . password_hash("mgmg123", PASSWORD_DEFAULT) . "','09254325731','dagon township, yangon',FALSE)";

$runinsert = $connection->query($insert);
if ($runinsert) {
    echo "<p>Successfully inserted staff</p>";
} else {
    echo $connection->error;
}
