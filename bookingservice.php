<?php
include('header.php');
include('connect.php');
if (isset($_SESSION['uid'])) {
    $userId = $_SESSION['uid'];
    if (isset($_REQUEST["serviceIdToBook"])) {
        $serviceIdToBook = $_REQUEST["serviceIdToBook"];
    } else {
        echo "<script>alert('Invaild Service!!')</script>";
        echo "<script>location='service.php'</script>";
    }
} else {
    echo "<script>alert('You can only book services after login. Please login first.')</script>";
    echo "<script>location='login.php'</script>";
}
$today = date("Ymd");
$rand = strtoupper(substr(uniqid(sha1(time())), 0, 5));
$bookingCode = "BS-" . $today . "-" . $rand;


$selectserviceTitle = "SELECT serviceName,cost from service where serviceId=$serviceIdToBook";
$runselectserviceTitle = $connection->query($selectserviceTitle);
$dataofserviceTitle = $runselectserviceTitle->fetch_array(MYSQLI_ASSOC);
$serviceTitle = $dataofserviceTitle['serviceName'];
$serviceCost = $dataofserviceTitle['cost'];

$selectuserName = "SELECT userName from user where userId=$userId";
$runselectuserName = $connection->query($selectuserName);
$dataofuserName = $runselectuserName->fetch_array(MYSQLI_ASSOC);
$userName = $dataofuserName['userName'];

if (isset($_POST['btnBookService'])) {
    $insert="INSERT into bookingservice(userId,serviceId,bookingCode,operationDate,operationTime,
            noofPatient,estimatedCost,bookingNote,status) values($userId,$serviceIdToBook,
            '".$_POST['tfBookingcode']."','".$_POST['tfOperationDate']."',
            '".$_POST['tfOperationTime']."',".$_POST['tfPatientNo'].",
            ".$_POST['tfCost'].",'".$_POST['tfNote']."',FALSE)";
    $runinsert=$connection->query($insert);
    if ($runinsert) {
        echo "<script>alert('Successfully booked the service')</script>";
        echo "<script>location='servicedetail.php?serviceIdToDetail=".$serviceIdToBook."'</script>";
    }else{
        echo "<script>alert('Booking process failed!')</script>";
    }
}
?>
<script type="text/javascript">
    document.getElementById("site-header").style.display = "none";
</script>

<!-- Login form -->
<section class="contact-form-wrap section" style="padding: 50px 0px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center" style="margin-bottom: 30px;">
                    <h2 class="text-md mb-2">Service Booking</h2>
                    <div class="divider mx-auto my-4"></div>
                    <p class="mb-2">You can view this booking status after done it.</p>
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
                                <label for="name" class="form-text">Service</label>
                                <input name="" id="name" type="text" class="form-control" value="<?php echo $serviceTitle; ?>" autocomplete="off" required readonly>
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
                                <label for="name" class="form-text">Name</label>
                                <input name="" id="name" type="text" class="form-control" value="<?php echo $userName; ?>" autocomplete="off" required readonly>
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
                                <label for="inputDateOperation" class="form-text">Date</label>
                                <input name="tfOperationDate" id="inputDateOperation" type="date" class="form-control" autocomplete="off" min="<?php echo date('Y-m-d'); ?>" required>
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
                                <label for="inputTimeOperation" class="form-text">Time</label>
                                <input name="tfOperationTime" id="inputTimeOperation" type="time" class="form-control" autocomplete="off" required>
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
                                <label for="inputPatientNo" class="form-text">Number of Patient</label>
                                <input name="tfPatientNo" id="inputPatientNo" type="number" onKeyDown="return false" class="form-control" autocomplete="off" min="1" required>
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
                                <label for="inputCost" class="form-text">Estimated Cost (MMK)</label>
                                <input name="tfCost" value="<?php echo $serviceCost; ?>" id="inputCost" type="number" class="form-control" autocomplete="off" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <textarea name="tfNote" id="" class="form-control" style="height: 200px;" placeholder="Booking Note (Optional)"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <input class="btn btn-main btn-round-full mx-2" name="btnBookService" type="submit" value="Done"></input>
                        <label class="form-text mt-3" style="text-decoration: underline;"><a href="service.php">Back to Service</a></label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include('footer.php');
?>
<script>
    document.getElementById("myUpanelFooter").style.display = "none";
    var originalcost="";
    $(document).ready(function() {
        document.getElementById("inputPatientNo").value=1;
        originalcost = document.getElementById("inputCost").value;
        var tfinputno=document.getElementById("inputPatientNo");
        tfinputno.addEventListener('change',patientnofunc)
    });

    function patientnofunc() {
        var patientno = document.getElementById("inputPatientNo").value;
        document.getElementById("inputCost").value=originalcost*patientno;
    }
</script>