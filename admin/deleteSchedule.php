<?php
include('../connect.php');
if (isset($_REQUEST['doctorIdToDeleteSchedule'])) {
    $doctorIdToDeleteSchedule = $_REQUEST['doctorIdToDeleteSchedule'];
    $deletequery = "DELETE from schedule where doctorId=$doctorIdToDeleteSchedule";
    $rundeletequery = $connection->query($deletequery);
    if ($rundeletequery) {
        echo "<script>alert('Successfully deleted..')</script>";
        echo "<script>location='doctorlist.php'</script>";
    }else{
        echo "<script>alert('Delete query failed')</script>";
        echo "<script>location='doctorlist.php'</script>";
    }

}
?>