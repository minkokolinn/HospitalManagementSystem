<?php
include("../connect.php");
$drop = "DROP table article";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped article</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table article
            (
                articleId int not null AUTO_INCREMENT,
                title text,
                subtitle text,
                category varchar(200),
                article text,
                uploadDate date,
                doctorId int,
                PRIMARY KEY(articleId),
                FOREIGN KEY(doctorId) REFERENCES doctor(doctorId)
            )";
$runcreate = $connection->query($create);

if ($runcreate) {
    echo "<p>Successfully created article</p>";
} else {
    echo $connection->error;
}

?>