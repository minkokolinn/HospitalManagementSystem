<?php
include('../connect.php');
if (isset($_REQUEST['apptIdToDelete'])) {
    $apptIdToDelete=$_REQUEST['apptIdToDelete'];
    $deletequery = "DELETE from appointment where appointmentId=$apptIdToDelete";
    $rundeletequery = $connection->query($deletequery);
    if ($rundeletequery) {
        echo "<script>alert('Successfully deleted..')</script>";
        echo "<script>location='appt.php'</script>";
    } else {
        echo "<script>alert('delete query failed!!!')</script>";
        echo "<script>location='appt.php'</script>";
    }
}

?>