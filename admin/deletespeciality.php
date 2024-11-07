<?php
include('../connect.php');
if (isset($_REQUEST['specIdToDelete'])) {
    $specIdToDelete=$_REQUEST['specIdToDelete'];
    $deletequery = "DELETE from speciality where specialityId=$specIdToDelete";
    $rundeletequery = $connection->query($deletequery);
    if ($rundeletequery) {
        echo "<script>alert('Successfully deleted..')</script>";
        echo "<script>location='speciality.php'</script>";
    } else {
        echo "<script>alert('delete query failed!!!')</script>";
        echo "<script>location='speciality.php'</script>";
    }
}

?>