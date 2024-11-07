<?php

session_start();
if ($_REQUEST['addToCart']=="on" && isset($_REQUEST['midToCart']) && isset($_REQUEST['quantity'])) {
    $mid=$_REQUEST['midToCart'];
    $quantity=$_REQUEST['quantity'];

    if (isset($_SESSION['cart'])) {
        array_push(
            $_SESSION['cart'],
            array(
                "mid"=>$mid,
                "quantity"=>$quantity
            )
        );
    }else{
        $_SESSION['cart']=array();
        array_push(
            $_SESSION['cart'],
            array(
                "mid"=>$mid,
                "quantity"=>$quantity
            )
        );
    }
    echo "<script>location='medicine.php'</script>";
}else{
    echo "<script>alert('invalid add to cart!')</script>";
    echo "<script>location='medicine.php'</script>";
}
