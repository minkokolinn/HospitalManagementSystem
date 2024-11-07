<?php
include("../connect.php");
$drop = "DROP table service";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped service</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table service
            (
                serviceId int not null AUTO_INCREMENT,
                serviceName varchar(100) not null UNIQUE,
                serviceDescription text not null,
                serviceImg varchar(70) not null,
                sec1 varchar(100),
                sec1Desp text,
                sec2 varchar(100),
                sec2Desp text,
                sec3 varchar(100),
                sec3Desp text,
                bookable boolean,
                cost int,
                stId int not null,
                PRIMARY KEY (serviceId),
                FOREIGN KEY (stId) REFERENCES servicetype(stId)
            )";
$runcreate = $connection->query($create);


if ($runcreate) {
    echo "<p>Successfully created service</p>";
} else {
    echo $connection->error;
}
