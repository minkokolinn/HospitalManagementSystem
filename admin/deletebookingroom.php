<?php
include('../connect.php');
if (isset($_REQUEST['brIdToDelete'])) {
    $brIdToDelete=$_REQUEST['brIdToDelete'];
    $deletequery = "DELETE from bookingroom where brId=$brIdToDelete";
    $rundeletequery = $connection->query($deletequery);
    if ($rundeletequery) {
        echo "<script>alert('Successfully deleted..')</script>";
        echo "<script>location='bookingroom.php'</script>";
    } else {
        echo "<script>alert('delete query failed!!!')</script>";
        echo "<script>location='bookingroom.php'</script>";
    }
}

?>