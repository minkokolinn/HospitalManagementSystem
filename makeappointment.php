<?php
include('header.php');
include('connect.php');

if (isset($_REQUEST['doctorIdToAppt'])) {
    $doctorId_appt = $_REQUEST['doctorIdToAppt'];

    //Check There's schedule or not
    $selectschedule = "SELECT * from schedule where doctorId=$doctorId_appt";
    $runselectschedule = $connection->query($selectschedule);
    $dataofschedule = $runselectschedule->fetch_all(MYSQLI_ASSOC);
    $countofschedule = $runselectschedule->num_rows;
    if ($countofschedule > 0) {
        $scheduleDays = array();
        foreach ($dataofschedule as $eachschedule) {
            array_push($scheduleDays, $eachschedule['dayOfSchedule']);
        }
    } else {
        echo "<script>alert('You cannot make an appointment for this doctor! Schedule had not been made yet!!')</script>";
        echo "<script>location='doctordetail.php?doctorIdToDetail=" . $doctorId_appt . "'</script>";
    }


    //Get Speciality and Doctor Name
    $selectdoctorinfo = "SELECT * from doctor d,speciality s where d.specialityId=s.specialityId and d.doctorId=$doctorId_appt";
    $runselectdoctorinfo = $connection->query($selectdoctorinfo);
    $dataofdoctorinfo = $runselectdoctorinfo->fetch_array(MYSQLI_ASSOC);
    $speciality = $dataofdoctorinfo['speciality'];
    $doctorName = $dataofdoctorinfo['doctorName'];
} else {
    echo "<script>alert('Invalid action!')</script>";
    echo "<script>location='finddoctor.php'</script>";
}

if (isset($_SESSION['uid'])) {
    $userId = $_SESSION['uid'];

    $selectuserName = "SELECT userName from user where userId=$userId";
    $runselectuserName = $connection->query($selectuserName);
    $dataofuserName = $runselectuserName->fetch_array(MYSQLI_ASSOC);
    $userName = $dataofuserName['userName'];
} else {
    echo "<script>alert('Please Login First!')</script>";
    echo "<script>location='login.php'</script>";
}

if (isset($_POST['btnAppointment'])) {
    $userId_forappt = $userId;
    $doctorId_forappt = $doctorId_appt;
    $phoneNumber_forappt = $_POST['tfPhoneNumber'];
    $yourmessage_forappt = $_POST['tfYourMessage'];
    $bookingDate_forappt = $_POST['tfBookingDate'];

    $dayofAppt = strtolower(date('D', strtotime($bookingDate_forappt)));

    if ($dayofAppt == "thu") {
        $dayofAppt = "thur";
    }

    $selectAppt = "SELECT * from appointment where doctorId=$doctorId_forappt and appt_date='$bookingDate_forappt'";
    $runselectAppt = $connection->query($selectAppt);
    if ($runselectAppt->num_rows > 0) {
        $dataofAppt=$runselectAppt->fetch_all(MYSQLI_ASSOC);
        $allAppointedTime=array();
        foreach ($dataofAppt as $eachAppt) {
            array_push($allAppointedTime,$eachAppt['appt_etime']);
        }
        $latestTime=max($allAppointedTime);
        $endTime = date("H:i:s", strtotime('+30 minutes', strtotime($latestTime)));
        
        $insertappointment = "INSERT into appointment(userId,doctorId,appt_date,appt_stime,appt_etime,phoneNumber,yourMessage
        ) values($userId_forappt,$doctorId_forappt,'$bookingDate_forappt','$latestTime','$endTime','$phoneNumber_forappt','$yourmessage_forappt')";
        $runinsertappointment = $connection->query($insertappointment);
        if ($runinsertappointment) {
            echo "<script>location='success_appt.php'</script>";
        } else {
            echo "<script>alert('Failed in appointment!')</script>";
        }
    } else {
        //Get Schedule Day Start Time and plus 30 minutes
        $checkScheduleStart = "SELECT * from schedule where dayOfSchedule='$dayofAppt' and doctorId=$doctorId_appt";
        $runcheckScheduleStart = $connection->query($checkScheduleStart);
        $dataofScheduleStart = $runcheckScheduleStart->fetch_array();
        $startTime = $dataofScheduleStart['startTime'];

        $appt_stime = date("H:i:s", strtotime('+30 minutes', strtotime($startTime)));

        $insertappointment = "INSERT into appointment(userId,doctorId,appt_date,appt_stime,appt_etime,phoneNumber,yourMessage
        ) values($userId_forappt,$doctorId_forappt,'$bookingDate_forappt','$startTime','$appt_stime','$phoneNumber_forappt','$yourmessage_forappt')";
        $runinsertappointment = $connection->query($insertappointment);
        if ($runinsertappointment) {
            echo "<script>location='success_appt.php'</script>";
        } else {
            echo "<script>alert('Failed in appointment!')</script>";
        }
    }
}

?>
<script>
    $(document).ready(function() {

        var today = new Date();
        var dd = today.getDate() + 1;
        var mm = today.getMonth() + 1; //January is 0 so need to add 1 to make it 1
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }

        var tomorrow = yyyy + '-' + mm + '-' + dd;
        document.getElementById("BookingDate").setAttribute("min", tomorrow);

        //setting schedule day checker
        var passedArray = <?php echo json_encode($scheduleDays); ?>;
        const picker = document.getElementById('BookingDate');
        var transferedArray = [];
        passedArray.forEach(element => {
            if (element == "sun") {
                transferedArray.push(0);
            } else if (element == "mon") {
                transferedArray.push(1);
            } else if (element == "tue") {
                transferedArray.push(2);
            } else if (element == "wed") {
                transferedArray.push(3);
            } else if (element == "thur") {
                transferedArray.push(4);
            } else if (element == "fri") {
                transferedArray.push(5);
            } else if (element == "sat") {
                transferedArray.push(6);
            }
        });

        picker.addEventListener('input', function(e) {
            var day = new Date(this.value).getUTCDay();
            if (!transferedArray.includes(day)) {
                e.preventDefault();
                this.value = '';
                alert('This is not schedule day!');
            }
        });
    });
</script>
<div id="site-start-section">

    <!-- <section class="page-title bg-1">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center">
                        <span class="text-white">Make an appointment to your doctor</span>
                        <h1 class="text-capitalize mb-5 text-lg">Appoinment</h1>

                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="appoinment section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="mt-3">
                        <div class="feature-icon mb-3">
                            <i class="icofont-support text-lg"></i>
                        </div>
                        <span class="h3">Call for an Emergency Service!</span>
                        <h2 class="text-color mt-3">+95 982728119 </h2>
                        <div class="sidebar-widget  gray-bg p-4">
                            <h5 class="mb-4">Schedule of <?php echo $doctorName; ?></h5>

                            <ul class="list-unstyled lh-35">
                                <?php
                                $selectschedule = "SELECT * from schedule s,doctor d where s.doctorId=d.doctorId and d.doctorId=$doctorId_appt";
                                $runselectschedule = $connection->query($selectschedule);
                                $dataofschedule = $runselectschedule->fetch_all(MYSQLI_ASSOC);
                                if ($runselectschedule->num_rows > 0) {
                                    foreach ($dataofschedule as $eachdata) {
                                        $dayofSchedule = $eachdata['dayOfSchedule'];
                                        $day = "";
                                        $stime = $eachdata['startTime'];
                                        $etime = $eachdata['endTime'];
                                        switch ($dayofSchedule) {
                                            case 'sun':
                                                $day = "Sunday";
                                                break;
                                            case 'mon':
                                                $day = "Monday";
                                                break;
                                            case 'tue':
                                                $day = "Tuesday";
                                                break;
                                            case 'wed':
                                                $day = "Wednesday";
                                                break;
                                            case 'thur':
                                                $day = "Thursday";
                                                break;
                                            case 'fri':
                                                $day = "Friday";
                                                break;
                                            case 'sat':
                                                $day = "Saturday";
                                                break;
                                            default:
                                                break;
                                        }
                                        echo "
                                    <li class='d-flex justify-content-between align-items-center'>
                                        <a href='#'>$day</a>
                                        <span>$stime - $etime</span>
                                    </li>
                                    ";
                                    }
                                } else {
                                    echo "
                                    <li class='d-flex justify-content-between align-items-center'>
                                        <span>No Schedule</span>
                                    </li>
                                    ";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="appoinment-wrap mt-5 mt-lg-0 pl-lg-5">
                        <h2 class="mb-2 title-color">Book an appoinment</h2>
                        <form class="appoinment-form" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input name="name" id="name" type="text" class="form-control" placeholder="Speciality" value="<?php echo $speciality; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input name="name" id="name" type="text" class="form-control" placeholder="Doctor Name" value="<?php echo $doctorName; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input name="name" id="name" type="text" class="form-control" placeholder="Full Name" value="Patient Name - <?php echo $userName; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input name="tfPhoneNumber" id="phone" type="Number" class="form-control" placeholder="Phone Number" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input name="tfBookingDate" id="BookingDate" type="date" class="form-control" required>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group-2 mb-4">
                                <textarea name="tfYourMessage" id="message" class="form-control" rows="6" placeholder="Your Message"></textarea>
                            </div>

                            <button type="submit" name="btnAppointment" class="btn btn-main btn-round-full">Make Appoinment <i class="icofont-simple-right ml-2"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php
include('footer.php');
?>