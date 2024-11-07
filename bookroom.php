<?php
include('header.php');
include('connect.php');
if (isset($_SESSION['uid'])) {
    $userId = $_SESSION['uid'];
    $selectusername = "SELECT userName from user where userId=$userId";
    $runselectusername = $connection->query($selectusername);
    $username = $runselectusername->fetch_array(MYSQLI_ASSOC);

    $today = date("Ymd");
    $rand = strtoupper(substr(uniqid(sha1(time())), 0, 5));
    $bookingCode = "BR-" . $today . "-" . $rand;
} else {
    echo "<script>alert('Please Login First!')</script>";
    echo "<script>location='login.php'</script>";
}
if (isset($_POST['btnBookRoom'])) {
    $reqInfo=$_POST['tfWard'].",".$_POST['tfRoomType'];
    $insert="INSERT into bookingroom(userId,bookingCode,useDate,reqInfo)
            values('$userId','".$_POST['tfBookingcode']."','".$_POST['tfDate']."',
            '$reqInfo')";
    $runinsert=$connection->query($insert);
    if ($runinsert) {
        echo "<script>alert('Successfully booked a room! Your room number will be displayed when your room is ready and booking has been assigned with a room!')</script>";
    }else{
        echo "<script>alert('Insert query failed!')</script>";
    }
}
?>
<section class="contact-form-wrap section" style="margin-top: 50px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    <h2 class="text-md mb-2">Book Hospital Room</h2>
                    <div class="divider mx-auto my-4"></div>
                    <p class="mb-5">After you submit this form, a room booking will be requested. You can find out states of your booking in your profile.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <form id="contact-form" method="post">
                    <!-- form message -->
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name" class="form-text">Booking Code</label>
                                <input name="tfBookingcode" id="name" type="text" class="form-control" value="<?php echo $bookingCode; ?>" autocomplete="off" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="username">User Name</label>
                                <input name="tfUserName" id="username" type="text" class="form-control" value="<?php echo $username['userName']; ?>" autocomplete="off" readonly required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="inputState">Hospital Ward (Choose your relevant ward)</label>
                                <select id="inputState" class="form-control" name="tfWard" required>
                                    <option value="">None</option>
                                    <?php
                                    $selectward = "SELECT * from ward";
                                    $runselectward = $connection->query($selectward);
                                    $wardlist = $runselectward->fetch_all(MYSQLI_ASSOC);
                                    foreach ($wardlist as $ward) {
                                        $wardId = $ward['wardId'];
                                        $wardName = $ward['wardName'];
                                        echo "<option value='$wardId'>$wardName</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="inputState">Room Type</label>
                                <select id="inputState" class="form-control" name="tfRoomType" required>
                                    <option value="">None</option>
                                    <?php
                                    $selectroomtype = "SELECT * from roomtype";
                                    $runselectroomtype = $connection->query($selectroomtype);
                                    $roomtypelist = $runselectroomtype->fetch_all(MYSQLI_ASSOC);
                                    foreach ($roomtypelist as $roomtype) {
                                        $rtId = $roomtype['rtId'];
                                        $rtName = $roomtype['rtName'];
                                        echo "<option value='$rtId'>$rtName</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="inputDateOperation" class="form-text">Date (Choose date when you will use this room?)</label>
                                <input name="tfDate" id="inputDateOperation" type="date" class="form-control" autocomplete="off" min="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <input class="btn btn-main btn-round-full mx-2" name="btnBookRoom" type="submit" value="Book"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
include('footer.php');
?>