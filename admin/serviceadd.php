<?php
include('header.php');
include('../connect.php');
if (isset($_POST['btnCreateService'])) {
    $bookable = 0;
    $cost = 0;
    if (isset($_POST['tfBookable'])) {
        $bookable = 1;
        $cost = $_POST['tfPrice'];
    }

    $arrayofsec1 = $_POST['sec1_fact'];
    $sec1full = "";
    foreach ($arrayofsec1 as $eachofsec1) {
        $sec1full .= $eachofsec1 . "||";
    }
    $sec2full = "";
    $arrayofsec2 = $_POST['sec2_fact'];
    foreach ($arrayofsec2 as $eachofsec2) {
        $sec2full .= $eachofsec2 . "||";
    }
    $sec3full = "";
    $arrayofsec3 = $_POST['sec3_fact'];
    foreach ($arrayofsec3 as $eachofsec3) {
        $sec3full .= $eachofsec3 . "||";
    }

    $targetfilepath = "serviceImg/" . basename($_FILES["tfImage"]["name"]);
    $uploadImg = 1;
    $imgFileType = strtolower(pathinfo($targetfilepath, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["tfImage"]["tmp_name"]);
    if ($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadImg = 1;
    } else {
        echo "<script>alert('File is not an image!')</script>";
        $uploadImg = 0;
    }
    if (file_exists($targetfilepath)) {
        echo "<script>alert('This file already exists!!')</script>";
        $uploadImg = 0;
    }
    if (
        $imgFileType != "jpg" && $imgFileType != "png" && $imgFileType != "jpeg"
        && $imgFileType != "gif" && $imgFileType != "webp"
    ) {
        echo "<script>alert('This file is not jpg,png,jpeg,gif files!!')</script>";
        $uploadImg = 0;
    }

    if ($uploadImg == 0) {
        echo "<script>alert('Your file does not match with rules!!Upload failed')</script>";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["tfImage"]["tmp_name"], $targetfilepath)) {
            // echo "The file " . htmlspecialchars(basename($_FILES["tfImage"]["name"])) . " has been uploaded.";
            $stidfk = $_POST['tfSt'];
            $insertservice = "INSERT into service(serviceName,serviceDescription,serviceImg,
                            sec1,sec1Desp,sec2,sec2Desp,sec3,sec3Desp,bookable,cost,stId) values
                            ('" . $_POST['tfTitle'] . "','" . $_POST['tfDescription'] . "','$targetfilepath',
                            '" . $_POST['tfSec1'] . "','$sec1full','" . $_POST['tfSec2'] . "','$sec2full',
                            '" . $_POST['tfSec3'] . "','$sec3full',$bookable,$cost,$stidfk)";
            $runinsertservice = $connection->query($insertservice);
            if ($runinsertservice) {
                echo "<script>alert('Successfully inserted a service')</script>";

                echo "<script>window.location='serviceadd.php'</script>";
            } else {
                if ($connection->errno == 1062) {
                    echo "<script>alert('This service has been already existed!!!')</script>";
                } else {
                    echo "<script>alert('Insert query failed!')</script>";
                    echo "Error : " . $connection->error;
                }
            }
        } else {
            echo "<script>alert('File Upload Error!')</script>";
        }
    }

    echo "<script>window.location='serviceadd.php'</script>";
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div class="row mt-2"><div class="col-10"><input type="text" name="sec1_fact[]" value="" class="form-control" style="float:left;" autocomplete="off"/></div><div class="col-2"><a href="javascript:void(0);" class="remove_button btn btn-danger"><i class="fas fa-minus"></i></a></div></div>'; //New input field html 
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function() {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent('div').parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
        // --------------------------------------------------------------------
        var addButton2 = $('.add_button2'); //Add button selector
        var wrapper2 = $('.field_wrapper2'); //Input field wrapper
        var fieldHTML2 = '<div class="row mt-2"><div class="col-10"><input type="text" name="sec2_fact[]" value="" class="form-control" style="float:left;" autocomplete="off"/></div><div class="col-2"><a href="javascript:void(0);" class="remove_button btn btn-danger"><i class="fas fa-minus"></i></a></div></div>'; //New input field html 
        var y = 1; //Initial field counter is 1
        //Once add button is clicked
        $(addButton2).click(function() {
            //Check maximum number of input fields
            if (y < maxField) {
                y++; //Increment field counter
                $(wrapper2).append(fieldHTML2); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper2).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent('div').parent('div').remove(); //Remove field html
            y--; //Decrement field counter
        });
        // ---------------------------------------------------------------
        var addButton3 = $('.add_button3'); //Add button selector
        var wrapper3 = $('.field_wrapper3'); //Input field wrapper
        var fieldHTML3 = '<div class="row mt-2"><div class="col-10"><input type="text" name="sec3_fact[]" value="" class="form-control" style="float:left;" autocomplete="off"/></div><div class="col-2"><a href="javascript:void(0);" class="remove_button btn btn-danger"><i class="fas fa-minus"></i></a></div></div>'; //New input field html 
        var z = 1; //Initial field counter is 1
        //Once add button is clicked
        $(addButton3).click(function() {
            //Check maximum number of input fields
            if (z < maxField) {
                z++; //Increment field counter
                $(wrapper3).append(fieldHTML3); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper3).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent('div').parent('div').remove(); //Remove field html
            z--; //Decrement field counter
        });


        //when bookable is unchecked, input cost is disabled.
        document.getElementById("inputCost").disabled = true;
        document.getElementById("bookCheckbox").addEventListener('change', function() {
            if (this.checked) {
                document.getElementById("inputCost").disabled = false;
            } else {
                document.getElementById("inputCost").disabled = true;
                document.getElementById("inputCost").value = "";
            }
        });
    });
</script>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-5">
            <h4 class="mt-4">Add New Service</h4>
            <div class="card mb-4 col-sm-10">
                <div class="card-body">
                    <p class="mb-0">
                        You can insert new services in this form.
                    </p>
                    <form method="post" class="mt-2" enctype="multipart/form-data">
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfTitle" placeholder="Service Title" autocomplete="off" required />
                            <label for="inputName">Service Title</label>
                        </div>
                        <div class="form-group mb-2">
                            <label for="inputImg" class="form-text">Image</label>
                            <input type="file" class="form-control" name="tfImage" accept="image/gif, image/jpeg, image/png, image/webp" required>
                        </div>
                        <div class="form-floating mb-2">
                            <textarea class="form-control" placeholder="Description" id="inputAddress" name="tfDescription" style="height: 250px" autocomplete="off" required></textarea>
                            <label for="inputAddress">Description</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfSec1" placeholder="Section 1 Title" autocomplete="off" />
                            <label for="inputName">Section 1 Title</label>
                        </div>
                        <div class="field_wrapper mb-4">
                            <div class="form-group">
                                <label class="form-text">Section 1 Facts</label>
                                <div class="row">
                                    <div class="col-10">
                                        <input type="text" name="sec1_fact[]" value="" class="form-control" autocomplete="off" />
                                    </div>
                                    <div class="col-2">
                                        <a href="javascript:void(0);" class="add_button btn btn-primary" title="Add field"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfSec2" placeholder="Section 1 Title" autocomplete="off" />
                            <label for="inputName">Section 2 Title</label>
                        </div>
                        <div class="field_wrapper2 mb-4">
                            <div class="form-group">
                                <label class="form-text">Section 2 Facts</label>
                                <div class="row">
                                    <div class="col-10">
                                        <input type="text" name="sec2_fact[]" value="" class="form-control" autocomplete="off" />
                                    </div>
                                    <div class="col-2">
                                        <a href="javascript:void(0);" class="add_button2 btn btn-primary" title="Add field"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfSec3" placeholder="Section 1 Title" autocomplete="off" />
                            <label for="inputName">Section 3 Title</label>
                        </div>
                        <div class="field_wrapper3 mb-4">
                            <div class="form-group">
                                <label class="form-text">Section 3 Facts</label>
                                <div class="row">
                                    <div class="col-10">
                                        <input type="text" name="sec3_fact[]" value="" class="form-control" autocomplete="off" />
                                    </div>
                                    <div class="col-2">
                                        <a href="javascript:void(0);" class="add_button3 btn btn-primary" title="Add field"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" name="tfBookable" id="bookCheckbox">
                            <label class="form-check-label" for="bookCheckbox">Bookable (Does it allows to be booked by users)</label>
                        </div>
                        <div class="form-floating col-5 mb-2">
                            <input class="form-control" id="inputCost" type="number" name="tfPrice" placeholder="Price" autocomplete="off" />
                            <label for="inputCost">Price (MMK)</label>
                        </div>
                        <div class="form-group col-5 mb-2">
                            <label class="form-text">Select a service type</label>
                            <select class="form-select" name="tfSt" aria-label="Default select example" required>
                                <option value="">None</option>
                                <?php
                                $selectst = "SELECT * from servicetype";
                                $runselectst = $connection->query($selectst);
                                $dataofst = $runselectst->fetch_all(MYSQLI_ASSOC);
                                foreach ($dataofst as $data) {
                                    echo "<option value='" . $data['stId'] . "'>" . $data['stServicetype'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mt-4">
                            <button type="reset" class="btn btn-secondary">Clear</button>
                            <button type="submit" name="btnCreateService" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
<?php
include('footer.php');
?>