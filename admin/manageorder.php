<?php
include('header.php');
include('../connect.php');
?>
<style>
    .actionlink {
        text-decoration: none;
    }

    .actionlink:hover {
        text-decoration: underline;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4">Order Medicine List</h4>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    You can view and manage order medicines' information.
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Order Code</th>
                                <th>User</th>
                                <th>Order Date</th>
                                <th>Delivery Method</th>
                                <th>Total</th>
                                <th>Delivered Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count=0;
                            $selectordermed="SELECT o.*,u.* from ordermed o, user u
                            where o.userId=u.userId";
                            $runselectordermed=$connection->query($selectordermed);
                            $dataofordermed=$runselectordermed->fetch_all(MYSQLI_ASSOC);
                            foreach ($dataofordermed as $eachorder) {
                                $count++; 
                                $orderDate=$eachorder['orderDate'];
                                $orderId=$eachorder['orderId'];
                                $orderCode=$orderDate."-OM".$orderId;
                                $userName=$eachorder['userName'];
                                $deli=$eachorder['deliveryMethod'];
                                $total=$eachorder['total'];
                                $deliverStatus=$eachorder['deliveredStatus'];
                                $deliver="";
                                if ($deliverStatus==0) {
                                    $deliver="Not Delivered";
                                }else{
                                    $deliver="<span class='text-success'>Delivered</span>";
                                }
                                echo "<tr>";
                                echo "<td>$count</td>";
                                echo "<td>$orderCode</td>";
                                echo "<td>$userName</td>";
                                echo "<td>$orderDate</td>";
                                echo "<td>$deli shipping</td>";
                                echo "<td>$total MMK</td>";
                                echo "<td>$deliver</td>";
                                echo "<td><a href='deletemanageorder.php?orderIdToDelete=$orderId' class='actionlink'><i class='fas fa-trash'></i>&nbsp;&nbspDelete</a><br>
                                <a href='orderdetail.php?oid=$orderId' class='actionlink'><i class='fas fa-eye'></i>&nbsp;&nbspView List</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Order Code</th>
                                <th>User</th>
                                <th>Order Date</th>
                                <th>Delivery Method</th>
                                <th>Total</th>
                                <th>Delivered Status</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>


    <!-- Modal dialog form -->
    <!-- <form method="post" enctype="multipart/form-data">
        <div class="modal fade" id="addMedicineDialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Medicine</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfmName" placeholder="Name" autocomplete="off" required />
                            <label for="inputName">Name</label>
                        </div>
                        <div class="mb-2">
                            <label for="inputName" class="form-text">Image</label>
                            <input class="form-control" id="inputName" type="file" name="tfmImg" placeholder="Image" autocomplete="off" required />
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfmSize" placeholder="Size" autocomplete="off" required />
                            <label for="inputName">Size</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfmMadein" placeholder="Made In" autocomplete="off" required />
                            <label for="inputName">Made In</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfmIngredient" placeholder="Ingredient" autocomplete="off" required />
                            <label for="inputName">Ingredient</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="number" name="tfmPrice" placeholder="Price" autocomplete="off" required />
                            <label for="inputName">Price (MMK)</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="number" name="tfmQuantity" placeholder="Quantity" autocomplete="off" required />
                            <label for="inputName">Quantity</label>
                        </div>
                        <div class="form-floating mb-2">
                            <textarea class="form-control" name="tfmDescription" placeholder="Description" id="inputAddress" style="height: 250px" autocomplete="off"></textarea>
                            <label for="inputAddress">Description</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Clear</button>
                        <button type="submit" name="btnCreateMedicine" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </form> -->
    <!-- -------------- -->
</div>
<?php
include('footer.php');
?>