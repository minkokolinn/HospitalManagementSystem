<?php
include("../connect.php");
$drop = "DROP table testimonial";
$rundrop = $connection->query($drop);
if ($rundrop) {
    echo "<p>Successfully dropped testimonial</p>";
} else {
    echo $connection->error;
}

$create = "CREATE table testimonial
            (
                testimonialId int not null AUTO_INCREMENT,
                userId int,
                testimonial text,
                uploadDate date,
                PRIMARY KEY (testimonialId),
                FOREIGN KEY (userId) REFERENCES user(userId)
            )";
$runcreate = $connection->query($create);

if ($runcreate) {
    echo "<p>Successfully created testimonial</p>";
} else {
    echo $connection->error;
}
$today_date=date('Y-m-d');
$insert = "INSERT into testimonial(userId,testimonial,uploadDate) values
            (1,'Awesome Webiste!','$today_date')";

$runinsert = $connection->query($insert);
if ($runinsert) {
    echo "<p>Successfully inserted testimonial</p>";
} else {
    echo $connection->error;
}
