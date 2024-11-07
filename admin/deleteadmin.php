<?php
include('../connect.php');
if (isset($_REQUEST['adminIdToDelete'])) {
    $adminIdToDelete=$_REQUEST['adminIdToDelete'];
    $deletequery = "DELETE from admin where adminId=$adminIdToDelete";
    $rundeletequery = $connection->query($deletequery);
    if ($rundeletequery) {
        echo "<script>alert('Successfully deleted..')</script>";
        echo "<script>location='adminlist.php'</script>";
    } else {
        echo "<script>alert('delete query failed!!!')</script>";
        echo "<script>location='adminlist.php'</script>";
    }
}

?>