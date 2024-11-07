<?php
include('header.php');
include('connect.php');
if (isset($_SESSION['uid'])) {
    $userId = $_SESSION['uid'];
    $selectuser = "SELECT * from user where userId=$userId";
    $runselectuser = $connection->query($selectuser);
    $dataofuser = $runselectuser->fetch_array(MYSQLI_ASSOC);
    $name = $dataofuser['userName'];
    $email = $dataofuser['userEmail'];
    $oldpasswordhash = $dataofuser['userPassword'];
    $phone = $dataofuser['userPhone'];
    $address = $dataofuser['userAddress'];
    $dob = $dataofuser['userDob'];
    $bt = $dataofuser['userBloodType'];
    $nrc = $dataofuser['userNrc'];
    $note = $dataofuser['userNote'];
} else {
    echo "<script>alert('Access Denied! Please login first.')</script>";
    echo "<script>window.location='login.php'</script>";
}

?>


<section class="page-title bg-1" style="margin-top: 80px;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block text-center">
                    <span class="text-white">Profile Detail</span>
                    <h1 class="text-capitalize mb-5 text-lg"><?php echo $name ?></h1>

                    <!-- <ul class="list-inline breadcumb-nav">
            <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
            <li class="list-inline-item"><span class="text-white">/</span></li>
            <li class="list-inline-item"><a href="#" class="text-white-50">Doctor Details</a></li>
          </ul> -->
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section doctor-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="doctor-img-block">
                    <!-- <img src="images/team/1.jpg" alt="" class="img-fluid w-100"> -->

                    <!-- <div class="info-block mt-4">
                        <h4 class="mb-0">Alexandar james</h4>
                        <p>Orthopedic Surgary</p>

                        <ul class="list-inline mt-4 doctor-social-links">
                            <li class="list-inline-item"><a href="#"><i class="icofont-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="icofont-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="icofont-skype"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="icofont-linkedin"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="icofont-pinterest"></i></a></li>
                        </ul>
                    </div> -->
                </div>
            </div>

            <div class="col-lg-7 col-md-6 bg-light d-flex justify-content-center pb-5">
                <div class="doctor-details mt-4 mt-lg-0">
                    <h2 class="text-md mt-4"><?php echo $name; ?></h2>
                    <div class="divider my-4"></div>
                    <h5 class="mb-4">Name - <?php echo $name; ?></h5>
                    <h5 class="mb-4">Email - <?php echo $email; ?></h5>
                    <h5 class="mb-4">Password - .............</h5>
                    <h5 class="mb-4">Phone - <?php echo $phone; ?></h5>
                    <h5 class="mb-4">Address - <?php echo $address; ?></h5>
                    <h5 class="mb-4">Dob - <?php echo $dob; ?></h5>
                    <h5 class="mb-4">Blood Type - <?php echo $bt; ?></h5>
                    <h5 class="mb-4">NRC - <?php echo $nrc; ?></h5>
                    <h5 class="mb-4">Note - <br><?php echo $note; ?></h5>
                    <a href="deactivateuser.php?userIdToDelete=<?php echo $userId; ?>" class="btn btn-main-2 btn-round-full mt-3">Deactivate Account<i class="icofont-simple-right ml-2  mb-4"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- My Appointment -->
<!-- My Service Booking -->
<?php
$selectappt = "SELECT * from appointment a,doctor d,user u where a.doctorId=d.doctorId and a.userId=u.userId and a.userId=$userId";
$runselectappt = $connection->query($selectappt);
$countofappt = $runselectappt->num_rows;
if ($countofappt > 0) {
    echo "
    <section class='section doctor-qualification gray-bg'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-6'>
                    <div class='section-title'>
                        <h3>My Appointment</h3>
                        <div class='divider my-4'></div>
                    </div>
                </div>
            </div>
            <div class='row'>
    ";
    $dataofappt = $runselectappt->fetch_all(MYSQLI_ASSOC);
    foreach ($dataofappt as $eachappt) {
        $doctorName=$eachappt['doctorName'];
        $patientName=$eachappt['userName'];
        $apptDate=$eachappt['appt_date'];
        $startTime=$eachappt['appt_stime'];
        $endTime=$eachappt['appt_etime'];
        echo "
            <div class='col-lg-6 mb-5'>
                <div class='card'>
                    <div class='card-header text-center'>
                        <h4 class='mb-3 title-color'>Appoinment with $doctorName</h4>
                    </div>
                    <div class='card-body'>
                        <div class='row'>
                            <div class='col-4'>
                                <p>Patient - <b>$patientName</b></p>
                                <p>Date - <b>$apptDate</b></p>
                            </div>
                            <div class='col-8'>
                                <p>Start Time - <b>$startTime</b></p>
                                <p>End Time - <b>$endTime</b></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>";
    }

    echo "
            </div>
        </div>
    </section>
        ";
}
?>





<!-- My Service Booking -->
<?php
$selectservicebooking = "SELECT * from bookingservice where userId=$userId";
$runselectservicebooking = $connection->query($selectservicebooking);
$countofbookingservice = $runselectservicebooking->num_rows;
if ($countofbookingservice > 0) {
    echo "
    <section class='section doctor-qualification gray-bg'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-6'>
                    <div class='section-title'>
                        <h3>My Service Booking</h3>
                        <div class='divider my-4'></div>
                    </div>
                </div>
            </div>
            <div class='row'>
    ";
    $dataofservicebooking = $runselectservicebooking->fetch_all(MYSQLI_ASSOC);
    foreach ($dataofservicebooking as $servicebooking) {
        $bookingcode = $servicebooking['bookingCode'];
        $date = $servicebooking['operationDate'];
        $time = $servicebooking['operationTime'];
        $price = $servicebooking['estimatedCost'];
        $status = $servicebooking['status'];
        $statusUI = "";
        if ($status == 1) {
            $statusUI = "<span class='text-success'>Confirmed</span>";
        } else {
            $statusUI = "Requested (still in progress)";
        }
        $investigationResult = $servicebooking['investigationResult'];
        $investigationShow = "";
        $investigationFileName = basename($investigationResult);
        if ($investigationResult == "") {
            $investigationShow = "Result not found";
        } else {
            $investigationShow = "Result posted : <a href='downloadInvestigation.php?downloadbs=admin/$investigationResult' style='text-decoration:underline;'>$investigationFileName</a>";
        }
        echo "
            <div class='col-lg-6 mb-5'>
                <div class='card'>
                    <div class='card-header text-center'>
                        <h4 class='mb-3 title-color'>$bookingcode</h4>
                    </div>
                    <div class='card-body'>
                        <div class='row'>
                            <div class='col-4'>
                                <p>Date - <b>$date</b></p>
                                <p>Time - <b>$time</b></p>
                            </div>
                            <div class='col-8'>
                                <p>Price - <b>$price MMK</b></p>
                                <p>Status - $statusUI</p>
                            </div>
                        </div>

                    </div>
                    <div class='card-footer'>
                        <div class='row'>
                            <p class='col'>$investigationShow</p>
                        </div>
                    </div>
                </div>
            </div>";
    }

    echo "
            </div>
        </div>
    </section>
        ";
}
?>

<!-- My Room Booking -->
<?php
$selectroombooking = "SELECT * from bookingroom where userId=$userId";
$runselectroombooking = $connection->query($selectroombooking);
$countofroombooking = $runselectroombooking->num_rows;
if ($countofroombooking > 0) {
    echo "
    <section class='section doctor-qualification gray-bg'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-6'>
                    <div class='section-title'>
                        <h3>My Room Booking</h3>
                        <div class='divider my-4'></div>
                    </div>
                </div>
            </div>
            <div class='row'>
    ";
    $dataofroombooking = $runselectroombooking->fetch_all(MYSQLI_ASSOC);
    foreach ($dataofroombooking as $roombooking) {
        $bookingcode = $roombooking['bookingCode'];
        $usedate = $roombooking['useDate'];
        $roomId = $roombooking['roomId'];
        $statusUI = "";
        if ($roomId == "") {
            $statusUI = "<span>Still requestion (Room not assigned)</span>";
        } else {
            $selectroom = "SELECT * from room r, ward w, roomtype rt 
                        where roomId=$roomId and r.wardId=w.wardId and r.rtId=rt.rtId";
            $runselectroom = $connection->query($selectroom);
            $dataofroom = $runselectroom->fetch_array(MYSQLI_ASSOC);
            $roomnumber = $dataofroom['roomNumber'];
            $roomtype = $dataofroom['rtName'];
            $ward = $dataofroom['wardName'];
            $statusUI = "<span class='text-success'>$roomnumber ($roomtype/$ward) had been assigned </span>";
        }
        echo "
            <div class='col-lg-6 mb-5'>
                <div class='card'>
                    <div class='card-header text-center'>
                        <h4 class='mb-3 title-color'>$bookingcode</h4>
                    </div>
                    <div class='card-body'>
                        <div class='row'>
                            <div class='col'>
                                <p>Use Date - <b>$usedate</b></p>
                                <p>$statusUI</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
    }

    echo "
            </div>
        </div>
    </section>
        ";
}
?>

<!-- My Order Medicine -->
<?php
$selectordermed = "SELECT * from ordermed where userId=$userId";
$runselectordermed = $connection->query($selectordermed);
$countofordermed = $runselectordermed->num_rows;
if ($countofordermed > 0) {
    echo "
    <section class='section doctor-qualification gray-bg'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-6'>
                    <div class='section-title'>
                        <h3>My Medicine Order</h3>
                        <div class='divider my-4'></div>
                    </div>
                </div>
            </div>
            <div class='row'>
    ";
    $dataofordermed = $runselectordermed->fetch_all(MYSQLI_ASSOC);
    foreach ($dataofordermed as $ordermed) {
        $bookingcode = $ordermed['orderDate'] . "-OM" . $ordermed['orderId'];
        $orderMedId = $ordermed['orderId'];
        $status = $ordermed['deliveredStatus'];
        $statusUI = "";
        if ($status == 0) {
            $statusUI = "Order finished";
        } else {
            $statusUI = "<span class='text-success'>Delivered</span>";
        }
        echo "
            <div class='col-lg-6 mb-5'>
                <div class='card'>
                    <div class='card-header text-center'>
                        <h4 class='mb-3 title-color'>$bookingcode</h4>
                    </div>
                    <div class='card-body'>
                        <div class='row'>
                            <div class='col'>
                                ";

        $selectorderdetail = "SELECT *, om.quantity as orderquantity from ordermedicine om, medicine m where om.medicineId=m.medicineId and om.orderId=$orderMedId";
        $runselectorderdetail = $connection->query($selectorderdetail);
        $dataoforderdetail = $runselectorderdetail->fetch_all(MYSQLI_ASSOC);
        foreach ($dataoforderdetail as $orderdetail) {
            $medName=$orderdetail['medicineName'];
            $orderquantity=$orderdetail['orderquantity'];
            echo "
                <p><b>$medName (x $orderquantity)</b></p>
            ";
        }


        echo "
                            </div>
                        </div>

                    </div>
                    <div class='card-footer'>
                        <div class='row'>
                            <p class='col'>$statusUI</p>
                        </div>
                    </div>
                </div>
            </div>";
    }

    echo "
            </div>
        </div>
    </section>
        ";
}
?>

<section class="section doctor-qualification ">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title">
                    <h3>My Testimonial</h3>
                    <div class="divider my-4"></div>
                </div>
            </div>
        </div>

        <div class="row">

            <?php
            $selectmytestimonial = "SELECT t.*,u.* from testimonial t, user u where t.userId=u.userId and u.userId=$userId";
            $runselectmytestimonial = $connection->query($selectmytestimonial);
            $count = $runselectmytestimonial->num_rows;
            if ($count > 0) {
                $dataoftestimonial = $runselectmytestimonial->fetch_all(MYSQLI_ASSOC);
                foreach ($dataoftestimonial as $dataone) {
                    $testimonialID = $dataone['testimonialId'];
                    $date = $dataone['uploadDate'];
                    $name = $dataone['userName'];
                    $testimonial = $dataone['testimonial'];
                    echo "
                    <div class='col-lg-6'>
                        <div class='edu-block mb-5'>
                            <span class='h6 text-muted'>$date </span>
                            <h4 class='mb-3 title-color'>$name</h4>
                            <p>$testimonial</p>
                            <a href='deletetestimonial.php?testimonialIdToDelete=$testimonialID' class='btn btn-danger'></i>Delete</a>
                        </div>
                    </div>
                    ";
                }
            }
            ?>
        </div>
    </div>
</section>

<?php
include('footer.php')
?>