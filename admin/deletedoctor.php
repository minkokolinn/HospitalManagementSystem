<?php
include('../connect.php');
if (isset($_REQUEST['doctorIdToDelete'])) {
    $doctorIdToDelete=$_REQUEST['doctorIdToDelete'];
    $deletequery = "DELETE from doctor where doctorId=$doctorIdToDelete";
    $rundeletequery = $connection->query($deletequery);
    if ($rundeletequery) {
        echo "<script>alert('Successfully deleted..')</script>";
        echo "<script>location='doctorlist.php'</script>";
    } else {
        echo "<script>alert('delete query failed!!!')</script>";
        echo "<script>location='doctorlist.php'</script>";
    }
}

?>