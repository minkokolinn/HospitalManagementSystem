<?php
include('connect.php');
if (isset($_REQUEST['testimonialIdToDelete'])) {
    $testimonialIdToDelete=$_REQUEST['testimonialIdToDelete'];
    $deletequery="DELETE from testimonial where testimonialId=$testimonialIdToDelete";
    $rundeletequery=$connection->query($deletequery);
    if ($rundeletequery) {
        echo "<script>alert('Successfully deleted');</script>";
        echo "<script>location='profile.php'</script>";
    }
}
?>