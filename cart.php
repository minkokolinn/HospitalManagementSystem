<?php
include('header.php');
include('connect.php');
if (isset($_SESSION['uid']) && isset($_SESSION['cart'])) {
    $userId = $_SESSION['uid'];
    $countofcart = sizeof($_SESSION['cart']);
} else {
    echo "<script>alert('Your cart is empty! Please order something to open cart!')</script>";
    echo "<script>location='medicine.php'</script>";
}

if (isset($_REQUEST['removeCart']) && $_REQUEST['removeCart'] == 'on') {
    echo "<script>
        var x=confirm('Are you sure to delete this cart');
        if(x==true){
            location='cart.php?yesCancelCart=yo';
        }else{
            location='cart.php';
        }
    </script>";
}
if (isset($_REQUEST['yesCancelCart'])) {
    unset($_SESSION['cart']);
    echo "<script>location='medicine.php'</script>";
}
if (isset($_POST['btnCheckout'])) {
    $today = date("Y/m/d");
    $insertordermed = "INSERT into ordermed(userId,orderDate,deliveryMethod,total,deliveredStatus)
                    values('$userId','$today','" . $_POST['shippingMethod'] . "','" . $_POST['tfHiddenTotal'] . "',
                    FALSE)";
    $runinsertordermed = $connection->query($insertordermed);
    if ($runinsertordermed) {
        $orderId = $connection->insert_id;
        foreach ($_SESSION['cart'] as $eachcart) {
            $mid = $eachcart['mid'];
            $quantity = $eachcart['quantity'];
            $insertordermedicine = "INSERT into ordermedicine(orderId,medicineId,quantity) values
                                    ('$orderId','$mid','$quantity')";
            $runinsertordermedicine = $connection->query($insertordermedicine);
            if ($runinsertordermedicine) {
                echo "<script>alert('You have ordered this cart successfully!')</script>";
                unset($_SESSION['cart']);
                echo "<script>location='medicine.php'</script>";
            }else{
                echo "<script>alert('Order medicine failed!')</script>";
            }
        }
    }
}


?>
<script>
    $(document).ready(function() {
        $('#deliBox').change(function() {
            let totalIncluding = 0;
            let totalItemCount = parseInt($('#totalItemCount').html());
            if ($('#deliBox').val() == "standard") {
                totalIncluding = totalItemCount + 1500;
            } else if ($('#deliBox').val() == "faster") {
                totalIncluding = totalItemCount + 4000;
            } else {
                totalIncluding = totalItemCount;
            }
            $('#totalShow').html(totalIncluding + " MMK");
            $('#hiddenTotal').val(totalIncluding);
        });
    });
</script>
<link rel="stylesheet" href="mycart.css">
<div style="margin-top: 100px; display: flex;">
    <div class="card my-5">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="title">
                    <div class="row">
                        <div class="col">
                            <h4><b>Shopping Cart</b></h4>
                        </div>
                        <div class="col align-self-center text-right text-muted">
                            <?php
                            echo ($countofcart == 1 ? $countofcart . " item" : $countofcart . " items");
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($_SESSION['cart'])) {
                    $theverytotal = 0;
                    foreach ($_SESSION['cart'] as $eachcart_arr) {
                        $mid = $eachcart_arr['mid'];
                        $quantity = $eachcart_arr['quantity'];
                        $selectmedicine = "SELECT * from medicine where medicineId=$mid";
                        $runselectmedicine = $connection->query($selectmedicine);
                        $dataofmed = $runselectmedicine->fetch_array(MYSQLI_ASSOC);
                        $img = $dataofmed['medicineImg'];
                        $name = $dataofmed['medicineName'];
                        $size = $dataofmed['size'];
                        $price = $dataofmed['price'];
                        $total = $quantity * $price;
                        $theverytotal = $theverytotal + $total;
                        echo "<div class='row border-top border-bottom'>
                        <div class='row main align-items-center'>
                            <div class='col-2'><img class='img-fluid' id='cartImg' src='admin/$img'></div>
                            <div class='col'>
                                <div class='row text-muted'>$name</div>
                                <div class='row'>$size</div>
                            </div>
                            <div class='col' style='text-align:center;'>$quantity</div>
                            <div class='col'>$total MMK <a href='removecart.php?midToRemove=$mid'><span class='close'>&#10005;</span></a></div>
                        </div>
                    </div>";
                    }
                }
                ?>
                <div class='back-to-shop'><a href='medicine.php'>&leftarrow;</a><span class='text-muted'>Back to shop</span></div>
            </div>
            <div class="col-md-4 summary">
                <div>
                    <h5><b>Summary</b></h5>
                </div>
                <hr>
                <div class="row">
                    <div class="col" style="padding-left:0;">ITEMS <?php echo $countofcart; ?></div>
                    <div class="col text-right"><span id="totalItemCount"><?php echo $theverytotal; ?></span> MMK</div>
                </div>
                <form method="post">
                    <p>SHIPPING</p>
                    <select id="deliBox" name="shippingMethod" required>
                        <option class="text-muted" value="">Choose Shipping Method</option>
                        <option class="text-muted" value="standard">Standard-Delivery - (+1500 MMK) within 1 week</option>
                        <option class="text-muted" value="faster">Faster-Delivery - (+4000 MMK) within 2 or 3 days</option>
                    </select>

                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">TOTAL PRICE</div>
                        <div class="col text-right" id="totalShow"><?php echo $theverytotal; ?> MMK</div>
                        <input type="text" id="hiddenTotal" name="tfHiddenTotal" readonly style="display: none;">
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="cart.php?removeCart=on" class="btn" style="background-color: brown; border-color:brown;">CANCEL CART</a>
                        </div>
                        <div class="col">
                            <button name="btnCheckout" class="btn" style="background-color: #17A2B8; border-color: #17A2B8;">CHECKOUT</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>