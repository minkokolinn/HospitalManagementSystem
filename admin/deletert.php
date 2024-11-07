<?php
include('../connect.php');
if (isset($_REQUEST['rtIdToDelete'])) {
    $rtIdToDelete = $_REQUEST['rtIdToDelete'];
    $deletequery = "DELETE from roomtype where rtId=$rtIdToDelete";


    $select = "SELECT rtImg from roomtype where rtId=$rtIdToDelete";
    $runselect = $connection->query($select);
    $dataofrt = $runselect->fetch_array(MYSQLI_ASSOC);
    if (unlink($dataofrt['rtImg'])) {
        echo "<script>alert('file deleted..')</script>";
        $rundeletequery = $connection->query($deletequery);
        if ($rundeletequery) {
            echo "<script>alert('Successfully deleted..')</script>";
            echo "<script>location='roomtypeadd.php'</script>";
        } else {
            echo "<script>alert('delete query failed!!!')</script>";
            echo "<script>location='roomtypeadd.php''</script>";
        }
    } else {
        echo ("$file_pointer cannot be deleted due to an error");
    }
}
