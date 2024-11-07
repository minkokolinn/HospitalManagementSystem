<?php
include('../connect.php');
if (isset($_REQUEST['deliverupdate'])) {
    $orderid = $_REQUEST['deliverupdate'];

    $updateordermed = "UPDATE ordermed set deliveredStatus=TRUE where orderId=$orderid";
    $runupdateordermed = $connection->query($updateordermed);
    if ($runupdateordermed) {
        $selectordermedicine = "SELECT om.*,o.*,m.*,om.quantity as orderquantity, m.quantity as originalquantity from ordermedicine om, ordermed o, medicine m
        where o.orderId=om.orderId and m.medicineId=om.medicineId 
        and om.orderId=$orderid";
        $runselectordermedicine = $connection->query($selectordermedicine);
        $dataofordermedicine = $runselectordermedicine->fetch_all(MYSQLI_ASSOC);
        foreach ($dataofordermedicine as $ordermedicine) {
            $mid=$ordermedicine['medicineId'];
            $quantity=$ordermedicine['orderquantity'];
            $orquantity=$ordermedicine['originalquantity'];
            $leftquantity=$orquantity-$quantity;

            $updatemedicine="UPDATE medicine set quantity=$leftquantity where medicineId=$mid";
            $runupdatemedicine=$connection->query($updatemedicine);
            if ($runupdatemedicine) {
                
            }else{
                echo "<script>alert('failed update in medicine')</script>";
            }
        }
        echo "<script>alert('Delivered successfully. Medicine quantity changed!')</script>";
        echo "<script>location='manageorder.php'</script>";
    }else{
        echo mysqli_error($connection);
    }
}
