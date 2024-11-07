<?php
include("../connect.php");
$drop = "DROP table admin";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped admin</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table admin
            (
                adminId int not null AUTO_INCREMENT,
                adminName varchar(30) not null,
                adminEmail varchar(50) not null UNIQUE,
                adminPassword text not null,
                adminPhone varchar(15),
                adminType varchar(6),
                PRIMARY KEY (adminId)
            )";
$runcreate = $connection->query($create);

if ($runcreate) {
    echo "<p>Successfully created admin</p>";
} else {
    echo $connection->error;
}

$insert = "INSERT into admin(adminName,adminEmail,adminPassword,adminPhone,adminType) values
            ('Admin','admin@gmail.com','" . password_hash("admin123", PASSWORD_DEFAULT) . "','09254325731','master')";

$runinsert = $connection->query($insert);
if ($runinsert) {
    echo "<p>Successfully inserted admin</p>";
} else {
    echo $connection->error;
}

//     $insert = "INSERT into admin(adminName,adminEmail,adminPassword,adminPhone,adminType) values
//     ('Admin','admin@gmail.com','" . password_hash("admin123", PASSWORD_DEFAULT) . "','09254325731','master')";

// $runinsert = $connection->query($insert);
// if ($runinsert) {
//     echo "<p>Successfully inserted admin</p>";
// } else {
//     echo $connection->error."<br>";
//     if ($connection->errno==1062) {
//         echo "This email has been already used....";
//     }
// }