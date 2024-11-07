<?php
include('../connect.php');
if (isset($_REQUEST['bsIdToDelete'])) {
    $bsIdToDelete=$_REQUEST['bsIdToDelete'];
    $deletequery = "DELETE from bookingservice where bsId=$bsIdToDelete";
    $rundeletequery = $connection->query($deletequery);
    if ($rundeletequery) {
        echo "<script>alert('Successfully deleted..')</script>";
        echo "<script>location='bookingservice.php'</script>";
    } else {
        echo "<script>alert('delete query failed!!!')</script>";
        echo "<script>location='bookingservice.php'</script>";
    }
}

?>