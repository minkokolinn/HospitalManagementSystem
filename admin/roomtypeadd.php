<?php
include('header.php');
include('../connect.php');
if (isset($_POST['btnCreateRoomType'])) {
    $filename = basename($_FILES['rtImage']['name']);
    $targetfilepath = "roomtypeImg/" . $filename;
    $filetype = strtolower(pathinfo($_FILES['rtImage']['name'], PATHINFO_EXTENSION));
    if (file_exists($targetfilepath)) {
        echo "<script>alert('This file already exists. You cannot upload this file and data! Try again')</script>";
    } else {
        if (
            $filetype == "png" || $filetype == "jpg" || $filetype == "jpeg" ||
            $filetype == "gif" || $filetype == "webp"
        ) {

            $arrayfacilities = $_POST['facilities'];
            $fullfacilities = "";
            foreach ($arrayfacilities as $eachone) {
                $fullfacilities .= $eachone . "||";
            }

            $insert = "INSERT into roomtype(rtName,rtSize,rtRate,rtImg,rtFaci)
                values('" . $_POST['rtName'] . "','" . $_POST['rtSize'] . "','" . $_POST['rtRate'] . "',
                '$targetfilepath','$fullfacilities')";
            $runinsert = $connection->query($insert);
            if ($runinsert) {
                if (move_uploaded_file($_FILES['rtImage']['tmp_name'], $targetfilepath)) {
                    echo "<script>alert('A new room type has been successfully inserted.')</script>";
                } else {
                    echo "<script>alert('File upload failed.')</script>";
                }
            } else {
                echo "<script>alert('Insert query failed!!')</script>";
            }
        } else {
            echo "<script>alert('This File does not match with relevant file type! You cannot upload this file and data! Try again!')</script>";
        }
    }
}
if (isset($_GET['rtIdToDelete'])) {
    echo "<script>
			var x=confirm('Are you sure to delete this room type?');
			if(x==true){
				location='deletert.php?rtIdToDelete=" . $_GET['rtIdToDelete'] . "';
			}else{
				location='roomtypeadd.php';
			}
		</script>";
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        var maxField = 10;
        var addButton = $('.add_button');
        var wrapper = $('.field_wrapper');
        var fieldHTML = '<div class="row mt-2"><div class="col-10"><input type="text" name="facilities[]" value="" class="form-control" style="float:left;" autocomplete="off"/></div><div class="col-2"><a href="javascript:void(0);" class="remove_button btn btn-danger"><i class="fas fa-minus"></i></a></div></div>';
        var x = 1;

        $(addButton).click(function() {
            if (x < maxField) {
                x++;
                $(wrapper).append(fieldHTML);
            }
        });
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
        });
    });
</script>
<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4">Room Type List (Room Rate)</h4>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    You can view and manage room type's information.
                    <button id="btnShowModalDialog" class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#addRoomTypeModal">New Room Type</button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Room Type</th>
                                <th>Size</th>
                                <th>Rate(Price per room)</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $select = "SELECT * from roomtype";
                            $runselect = $connection->query($select);
                            $datalistrt = $runselect->fetch_all(MYSQLI_ASSOC);
                            $count=0;
                            foreach ($datalistrt as $dataeach) {
                                $count++;
                                $rtId=$dataeach['rtId'];
                                $rtName = $dataeach['rtName'];
                                $rtSize = $dataeach['rtSize'];
                                $rtRate = $dataeach['rtRate'];
                                $rtImg = $dataeach['rtImg'];
                                $rtFaci = $dataeach['rtFaci'];
                                echo "
                                <tr>
                                    <td>$count</td>
                                    <td>$rtName</td>
                                    <td>$rtSize sqft</td>
                                    <td>$rtRate MMK</td>
                                    <td><img src='$rtImg' style='width:50px; height:auto;''></td>
                                    <td><a href='roomtypeadd.php?rtIdToDelete=$rtId' class='actionlink'><i class='fas fa-trash'></i>&nbsp;&nbspDelete</a></td>
                                </tr>
                                ";
                            }

                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Room Type</th>
                                <th>Size</th>
                                <th>Rate(Price per room)</th>
                                <th>Image</th>
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
        <div class="modal fade" id="addRoomTypeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Room Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="rtName" placeholder="Room Type Name" autocomplete="off" required />
                            <label for="inputName">Room Type Name</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputEmail" type="number" name="rtSize" placeholder="Room Size (sqft)" autocomplete="off" required />
                            <label for="inputEmail">Room Size (sqft)</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputEmail" type="number" name="rtRate" placeholder="Room Rate (MMK)" autocomplete="off" required />
                            <label for="inputEmail">Room Rate (MMK)</label>
                        </div>
                        <div class="form-group mb-2">
                            <label for="inputEmail" class="form-text">Image</label>
                            <input class="form-control" id="inputEmail" type="file" name="rtImage" placeholder="Image" autocomplete="off" required />
                        </div>
                        <div class="field_wrapper mb-4">
                            <div class="form-group">
                                <label class="form-text">Facilities</label>
                                <div class="row">
                                    <div class="col-10">
                                        <input type="text" name="facilities[]" value="" class="form-control" autocomplete="off" required />
                                    </div>
                                    <div class="col-2">
                                        <a href="javascript:void(0);" class="add_button btn btn-primary" title="Add field"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Clear</button>
                        <button type="submit" name="btnCreateRoomType" class="btn btn-primary">Create</button>
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