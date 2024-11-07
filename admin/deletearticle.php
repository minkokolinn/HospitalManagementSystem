<?php
include('../connect.php');
if (isset($_REQUEST['articleIdToDelete'])) {
    $articleIdToDelete=$_REQUEST['articleIdToDelete'];
    $deletequery = "DELETE from article where articleId=$articleIdToDelete";
    $rundeletequery = $connection->query($deletequery);
    if ($rundeletequery) {
        echo "<script>alert('Successfully deleted..')</script>";
        echo "<script>location='article.php'</script>";
    } else {
        echo "<script>alert('delete query failed!!!')</script>";
        echo "<script>location='article.php'</script>";
    }
}

?>