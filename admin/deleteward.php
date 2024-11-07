<?php
include('../connect.php');
if (isset($_REQUEST['wardIdToDelete'])) {
    $wardIdToDelete = $_REQUEST['wardIdToDelete'];
    $deletequery = "DELETE from ward where wardId=$wardIdToDelete";
    $rundeletequery = $connection->query($deletequery);
    if ($rundeletequery) {
        echo "<script>alert('Successfully deleted..')</script>";
        echo "<script>location='wardadd.php'</script>";
    }else{
        echo "<script>alert('Delete query failed')</script>";
        echo "<script>location='wardadd.php'</script>";
    }

}
