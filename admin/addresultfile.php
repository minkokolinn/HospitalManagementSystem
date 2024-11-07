<?php
include('header.php');
include('../connect.php');
if (isset($_REQUEST['bsIdToFile'])) {
    $bsId = $_REQUEST['bsIdToFile'];
} else {
    echo "<script>alert('Invalid Booking')</script>";
    echo "<script>location='bookingservice.php'</script>";
}
if (isset($_POST['btnAddFile'])) {
    $targetfilepath = "investigation/" . basename($_FILES["inputFile"]["name"]);
    $uploadImg = 1;
    $imgFileType = strtolower(pathinfo($targetfilepath, PATHINFO_EXTENSION));
    if (file_exists($targetfilepath)) {
        echo "<script>alert('This file already exists!!')</script>";
        $uploadImg = 0;
    }
    if ($uploadImg == 0) {
        echo "<script>alert('Your file does not match with rules!!Upload failed')</script>";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["inputFile"]["tmp_name"], $targetfilepath)) {           
            $updatefilepath = "UPDATE bookingservice set investigationResult='$targetfilepath' where bsId=$bsId";
            $runupdatefile = $connection->query($updatefilepath);
            if ($runupdatefile) {
                echo "<script>alert('Successfully added file')</script>";
                echo "<script>window.location='bookingservice.php'</script>";
            } else {
                    echo "<script>alert('Insert query failed!')</script>";
                    
            }
        } else {
            echo "<script>alert('File Upload Error!')</script>";
        }
    }
}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-5">
            <h4 class="mt-4">Add Investigation Result</h4>
            <div class="card mb-4 col-sm-10">
                <div class="card-body">
                    <p class="mb-0">

                    </p>
                    <form method="post" class="mt-2" enctype="multipart/form-data">
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputFile" type="file" name="inputFile" placeholder="File" autocomplete="off" required />
                        </div>
                        <div class="mt-4">
                            <a href="bookingservice.php" class="btn btn-secondary">Back</a>
                            <button type="submit" name="btnAddFile" class="btn btn-primary">Add</button>
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