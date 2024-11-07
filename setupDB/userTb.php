<?php
include("../connect.php");
$drop = "DROP table user";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped user</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table user
            (
                userId int not null AUTO_INCREMENT,
                userName varchar(30) not null,
                userEmail varchar(50) not null UNIQUE,
                userPassword text not null,
                userPhone varchar(15) not null,
                userAddress text not null,
                userDob date not null,
                userBloodType varchar(5) not null,
                userNrc varchar(20) not null,
                userNote text,
                PRIMARY KEY (userId)
            )";
$runcreate = $connection->query($create);

if ($runcreate) {
    echo "<p>Successfully created user</p>";
} else {
    echo $connection->error;
}

$insert = "INSERT into user(userName,userEmail,userPassword,userPhone,userAddress,userDob,userBloodType,userNrc,userNote) values
            ('Min','min@gmail.com','" . password_hash("min123", PASSWORD_DEFAULT) . "','09254325731','dagon township, yangon','2002-01-28','A','12/DaDaDa(N)111111','Penicillin allergy')";

$runinsert = $connection->query($insert);
if ($runinsert) {
    echo "<p>Successfully inserted user</p>";
} else {
    echo $connection->error;
}
