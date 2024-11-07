<?php
include('../connect.php');
if (isset($_REQUEST['orderIdToDelete'])) {
    $orderIdToDelete = $_REQUEST['orderIdToDelete'];

    $deletequery2 = "DELETE from ordermedicine where orderId=$orderIdToDelete";
    $rundeletequery2 = $connection->query($deletequery2);


    if ($rundeletequery2) {
        $deletequery = "DELETE from ordermed where orderId=$orderIdToDelete";
        $rundeletequery = $connection->query($deletequery);
        if ($rundeletequery) {
            echo "<script>alert('Successfully deleted..')</script>";
            echo "<script>location='manageorder.php'</script>";
        } else {
            echo "<script>alert('delete query 2 failed!!!..')</script>";
            echo "<script>location='manageorder.php'</script>";
        }
    } else {
        echo "<script>alert('delete query 1 failed!!!')</script>";
        echo "<script>location='manageorder.php'</script>";
    }
}
