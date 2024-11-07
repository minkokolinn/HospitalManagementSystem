<?php
include('connect.php');
if (isset($_REQUEST['userIdToDelete'])) {
    $userIdToDelete=$_REQUEST['userIdToDelete'];
    $deletequery = "DELETE from user where userId=$userIdToDelete";
    $rundeletequery = $connection->query($deletequery);
    if ($rundeletequery) {
        echo "<script>alert('Successfully deactivated your account!..')</script>";
        echo "<script>location='logout.php'</script>";
    } else {
        echo "<script>alert('delete query failed!!!')</script>";
        echo "<script>location='profile.php'</script>";
    }
}

?>