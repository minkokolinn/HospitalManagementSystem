<?php
include('../connect.php');
if (isset($_REQUEST['roomIdToDelete'])) {
    $roomIdToDelete = $_REQUEST['roomIdToDelete'];
    $deletequery = "DELETE from room where roomId=$roomIdToDelete";
    $rundeletequery = $connection->query($deletequery);
    if ($rundeletequery) {
        echo "<script>alert('Successfully deleted..')</script>";
        echo "<script>location='roomlist.php'</script>";
    }else{
        echo "<script>alert('Delete query failed')</script>";
        echo "<script>location='roomlist.php'</script>";
    }

}
