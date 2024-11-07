<?php
include('header.php');
include('../connect.php');
if (isset($_REQUEST['oid'])) {
    $orderdetailId = $_REQUEST['oid'];

    $selectordermed = "SELECT * FROM ordermed where orderId=$orderdetailId";
    $runselectordermed = $connection->query($selectordermed);
    $dataofordermed = $runselectordermed->fetch_array(MYSQLI_ASSOC);
    $totalall = $dataofordermed['total'];
    $deliveredStatus = $dataofordermed['deliveredStatus'];
    $userIdFrom = $dataofordermed['userId'];

    $selectcus = "SELECT userName from user where userId=$userIdFrom";
    $runselectcus = $connection->query($selectcus);
    $dataofcus = $runselectcus->fetch_array(MYSQLI_ASSOC);
    $customer = $dataofcus['userName'];
} else {
    echo "<script>alert('Invalid')</script>";
    echo "<script>location='manageorder.php'</script>";
}
?>
<script>
    function goManageOrder() {
        location = 'manageorder.php';
    }
</script>

<div id="layoutSidenav_content">
    <div class="container px-4 my-5">
        <div class="row">
            <div class="col-3">
                <button class="btn btn-secondary" onclick="goManageOrder()">Back</button>
            </div>
        </div>
        <div class="table-responsive mt-3">
            <table class="table">
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Count</th>
                    <th>Total Price for this item</th>
                </tr>
                <?php
                $selectordermedicine = "SELECT om.*,o.*,m.*,om.quantity as orderquantity from ordermedicine om, ordermed o, medicine m
                                    where o.orderId=om.orderId and m.medicineId=om.medicineId 
                                    and om.orderId=$orderdetailId";
                $runselectordermedicine = $connection->query($selectordermedicine);
                $dataofordermedicine = $runselectordermedicine->fetch_all(MYSQLI_ASSOC);
                $no = 0;
                foreach ($dataofordermedicine as $ordermedicine) {
                    $no++;
                    $medImg = $ordermedicine['medicineImg'];
                    $product = $ordermedicine['medicineName'];
                    $quantity = $ordermedicine['orderquantity'];
                    $totalforeach = $ordermedicine['price'] * $quantity;
                    echo "<tr>";
                    echo "<td>$no</td>";
                    echo "<td><img src='$medImg' style='width:50px; height:auto;''></td>";
                    echo "<td>$product</td>";
                    echo "<td>$quantity</td>";
                    echo "<td>$totalforeach MMK</td>";
                    echo "</tr>";
                }
                ?>
                <tr>
                    <td colspan="4"></td>
                    <td class="fw-bold">Total - <span><?php echo $totalall; ?> MMK (including shipping fees)</span></td>
                </tr>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            <!-- <a href="javascript:window.print()" class="btn btn-primary pull-right">Print</a> -->
            <a href="" class="btn btn-secondary mx-3" data-bs-toggle='modal' data-bs-target='#orderDetailModal'>Print/Detail</a>
            <?php
            if ($deliveredStatus == 0) {
                echo "<a href='deliverupdate.php?deliverupdate=$orderdetailId' class='col-3 btn btn-primary'>Deliver</a>";
            }
            ?>

        </div>
    </div>
</div>

<!-- Order Detail -->
<form method="post">
    <div class="modal fade" id="orderDetailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Medicine Order Voucher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="goReload()"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">
                        <tr>

                        </tr>
                        <tr>
                            <td>Order Number</td>
                            <td><b><?php echo $dataofordermed['orderDate'] . "-OM" . $dataofordermed['orderId']; ?></b></td>
                        </tr>
                        <tr>
                            <td>Order Date</td>
                            <td><b><?php echo $dataofordermed['orderDate']; ?></b></td>
                        </tr>
                        <tr>
                            <td>Customer</td>
                            <td><b style="text-decoration: underline;"><?php echo $customer ?></b></td>
                        </tr>
                        <tr>
                            <td>Delivery Method</td>
                            <td><b><?php echo $dataofordermed['deliveryMethod']; ?></b></td>
                        </tr>
                        <tr>
                            <table class="table">
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Count</th>
                                    <th>Total Price for this item</th>
                                </tr>
                                <?php
                                $selectordermedicine = "SELECT om.*,o.*,m.*,om.quantity as orderquantity from ordermedicine om, ordermed o, medicine m
                                    where o.orderId=om.orderId and m.medicineId=om.medicineId 
                                    and om.orderId=$orderdetailId";
                                $runselectordermedicine = $connection->query($selectordermedicine);
                                $dataofordermedicine = $runselectordermedicine->fetch_all(MYSQLI_ASSOC);
                                $no = 0;
                                foreach ($dataofordermedicine as $ordermedicine) {
                                    $no++;
                                    $medImg = $ordermedicine['medicineImg'];
                                    $product = $ordermedicine['medicineName'];
                                    $quantity = $ordermedicine['orderquantity'];
                                    $totalforeach = $ordermedicine['price'] * $quantity;
                                    echo "<tr>";
                                    echo "<td>$no</td>";
                                    echo "<td><img src='$medImg' style='width:50px; height:auto;''></td>";
                                    echo "<td>$product</td>";
                                    echo "<td>$quantity</td>";
                                    echo "<td>$totalforeach MMK</td>";
                                    echo "</tr>";
                                }
                                ?>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2" class="fw-bold">Total - <span><?php echo $totalall; ?> MMK (including shipping fees)</span></td>
                                </tr>
                            </table>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <a href="javascript:window.print()" class="btn btn-primary pull-right">Print</a>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- -------------- -->

<?php
include('footer.php');
?>