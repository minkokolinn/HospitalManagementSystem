<?php
session_start();
if (isset($_REQUEST['midToRemove'])) {
    foreach ($_SESSION['cart'] as $key=>$eachcart) {
        if ($eachcart['mid']==$_REQUEST['midToRemove']) {
            if (sizeof($_SESSION['cart'])==1) {
                unset($_SESSION['cart']);
                echo "<script>location='index.php'</script>";
            }else{
                unset($_SESSION['cart'][$key]);
            }
            
        }
    }
    echo "<script>location='cart.php'</script>";
}
?>