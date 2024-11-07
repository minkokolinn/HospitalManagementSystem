<?php
include('header.php');
include('../connect.php');
if (isset($_POST['btnCreateMedicine'])) {
    $filename = basename($_FILES['tfmImg']['name']);
    $targetfilepath = "medicineImg/" . $filename;
    $filetype = strtolower(pathinfo($targetfilepath, PATHINFO_EXTENSION));
    if (file_exists($targetfilepath)) {
        echo "<script>alert('This file already exists. You cannot upload this file and data! Try again')</script>";
    } else {
        if (
            $filetype == "png" || $filetype == "jpg" || $filetype == "jpeg" ||
            $filetype == "gif" || $filetype == "webp"
        ) {
            $mName=$_POST['tfmName'];
            $mSize=$_POST['tfmSize'];
            $mMadein=$_POST['tfmMadein'];
            $mIngredient=$_POST['tfmIngredient'];
            $mPrice=$_POST['tfmPrice'];
            $mQuantity=$_POST['tfmQuantity'];
            $mDescription=$_POST['tfmDescription'];

            $insert="INSERT into medicine(medicineName,medicineImg,size,madein,ingredient,price,quantity,description)
                    values('$mName','$targetfilepath','$mSize','$mMadein','$mIngredient',
                    $mPrice,$mQuantity,'$mDescription')";
            $runinsert=$connection->query($insert);
            if ($runinsert) {
                if (move_uploaded_file($_FILES['tfmImg']['tmp_name'],$targetfilepath)) {
                    echo "<script>alert('Successfully inserted an medicine...')</script>";
                }else{
                    echo "<script>alert('Failed upload file')</script>";
                }
            }else{
                echo "<script>alert('Insert query failed!')</script>";
                echo $connection->error;
            }
        } else {
            echo "<script>alert('This File does not match with relevant file type! You cannot upload this file and data! Try again!')</script>";
        }
    }
}
if (isset($_GET['midToDelete'])) {
    echo "<script>
			var x=confirm('Are you sure to delete this medicine?');
			if(x==true){
				location='deletemedicine.php?midToDelete=" . $_GET['midToDelete'] . "';
			}else{
				location='addmedicine.php';
			}
		</script>";
}
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
            <h4 class="mt-4">Medicine List</h4>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    You can view and manage medicines' information.
                    <button id="btnShowModalDialog" class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#addMedicineDialog">New Medicine</button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Madein</th>
                                <th>Price</th>
                                <th>Qantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $select="SELECT * from medicine";
                            $runselect=$connection->query($select);
                            $datamedicine=$runselect->fetch_all(MYSQLI_ASSOC);
                            $count=0;
                            foreach ($datamedicine as $eachone) {
                                $count++; 
                                $mid=$eachone['medicineId'];
                                $image=$eachone['medicineImg'];
                                $name=$eachone['medicineName'];
                                $size=$eachone['size'];
                                $madein=$eachone['madein'];
                                $price=$eachone['price'];
                                $quantity=$eachone['quantity'];
                                echo "<tr>";
                                echo "<td>$count</td>";
                                echo "<td><img src='$image' style='width:50px; height:auto;''></td>";
                                echo "<td>$name</td>";
                                echo "<td>$size</td>";
                                echo "<td>$madein</td>";
                                echo "<td>$price</td>";
                                echo "<td>$quantity</td>";
                                echo "<td><a href='addmedicine.php?midToDelete=$mid' class='actionlink'><i class='fas fa-trash'></i>&nbsp;&nbspDelete</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Madein</th>
                                <th>Price</th>
                                <th>Qantity</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>


    <!-- Modal dialog form -->
    <form method="post" enctype="multipart/form-data">
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
    </form>
    <!-- -------------- -->
</div>
<?php
include('footer.php');
?>