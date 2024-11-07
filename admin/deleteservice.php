<?php
include('../connect.php');
if (isset($_REQUEST['serviceIdToDelete'])) {
    $serviceIdToDelete=$_REQUEST['serviceIdToDelete'];
    $deletequery = "DELETE from service where serviceId=$serviceIdToDelete";
    

    $selectservice="SELECT serviceImg from service where serviceId=$serviceIdToDelete";
    $runselectservice=$connection->query($selectservice);
    $dataofservice=$runselectservice->fetch_array(MYSQLI_ASSOC);
    if (unlink($dataofservice['serviceImg'])) { 
        echo "<script>alert('file deleted..')</script>";
        $rundeletequery = $connection->query($deletequery);
        if ($rundeletequery) {
            echo "<script>alert('Successfully deleted..')</script>";
            echo "<script>location='servicelist.php'</script>";
        } else {
            echo "<script>alert('delete query failed!!!')</script>";
            echo "<script>location='servicelist.php'</script>";
        }
    } 
    else { 
        echo ("$file_pointer cannot be deleted due to an error"); 
    } 
    
}
