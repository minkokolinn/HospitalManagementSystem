<?php
include('../connect.php');
if (isset($_REQUEST['staffIdToDelete'])) {
    $staffIdToDelete=$_REQUEST['staffIdToDelete'];
    $deletequery = "DELETE from staff where staffId=$staffIdToDelete";
    $rundeletequery = $connection->query($deletequery);
    if ($rundeletequery) {
        echo "<script>alert('Successfully deleted..')</script>";
        echo "<script>location='stafflist.php'</script>";
    } else {
        echo "<script>alert('delete query failed!!!')</script>";
        echo "<script>location='stafflist.php'</script>";
    }
}

?>