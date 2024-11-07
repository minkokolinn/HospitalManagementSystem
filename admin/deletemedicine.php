<?php
include('../connect.php');
if (isset($_REQUEST['midToDelete'])) {
    $midToDelete = $_REQUEST['midToDelete'];
    $deletequery = "DELETE from medicine where medicineId=$midToDelete";


    $select = "SELECT medicineImg from medicine where medicineId=$midToDelete";
    $runselect = $connection->query($select);
    $dataofrt = $runselect->fetch_array(MYSQLI_ASSOC);
    if (unlink($dataofrt['medicineImg'])) {
        echo "<script>alert('file deleted..')</script>";
        $rundeletequery = $connection->query($deletequery);
        if ($rundeletequery) {
            echo "<script>alert('Successfully deleted..')</script>";
            echo "<script>location='addmedicine.php'</script>";
        } else {
            echo "<script>alert('delete query failed!!!')</script>";
            echo "<script>location='addmedicine.php''</script>";
        }
    } else {
        echo ("$file_pointer cannot be deleted due to an error");
    }
}
