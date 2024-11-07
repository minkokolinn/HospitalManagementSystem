<?php
include("../connect.php");
$drop = "DROP table servicetype";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped servicetype</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table servicetype
            (
                stId int not null AUTO_INCREMENT,
                stServicetype varchar(30) not null,
                stDescription text,
                PRIMARY KEY(stId)
            )";
$runcreate = $connection->query($create);

if ($runcreate) {
    echo "<p>Successfully created service type</p>";
} else {
    echo $connection->error;
}

$insert = "INSERT into servicetype(stServicetype,stDescription) values
            ('Imaging Service',''),
            ('Clinical Service',''),
            ('Specialist Service',''),
            ('Patient Service','')";

$runinsert = $connection->query($insert);
if ($runinsert) {
    echo "<p>Successfully inserted service types</p>";
} else {
    echo $connection->error;
}