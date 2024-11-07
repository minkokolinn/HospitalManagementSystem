<?php
include('header.php');
include('connect.php');
if (isset($_REQUEST['doctorIdToDetail'])) {
    $doctorIdToDetail = $_REQUEST['doctorIdToDetail'];
    $selectdoctor = "SELECT * from doctor d,speciality s where d.specialityId=s.specialityId and d.doctorId=$doctorIdToDetail";
    $runselectdoctor = $connection->query($selectdoctor);
    $dataofdoctor = $runselectdoctor->fetch_array(MYSQLI_ASSOC);
} else {
    echo "<script>alert('Invalid action!')</script>";
    echo "<script>location='finddoctor.php'</script>";
}
?>
<div id="site-start-section">
    <section class="page-title bg-1">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center">
                        <span class="text-white">Doctor Details</span>
                        <h1 class="text-capitalize mb-5 text-lg"><?php echo $dataofdoctor['doctorName'] ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section doctor-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="doctor-img-block">
                        <img src="images/doctor_avator.png" alt="" class="img-fluid w-100">
                        <div class="info-block mt-4">
                            <h4 class="mb-0"><?php echo $dataofdoctor['doctorName'] ?></h4>
                            <p><?php echo $dataofdoctor['speciality'] ?></p>

                            <ul class="list-inline mt-4 doctor-social-links">
                                <li class="list-inline-item"><a href="#"><i class="icofont-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="icofont-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="icofont-skype"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="icofont-linkedin"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="icofont-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-6">
                    <div class="doctor-details mt-4 mt-lg-0">
                        <h2 class="text-md">Introducing to myself</h2>
                        <div class="divider my-4"></div>
                        <p><?php echo $dataofdoctor['introduction'] ?></p>
                        <a href="makeappointment.php?doctorIdToAppt=<?php echo $doctorIdToDetail; ?>" class="btn btn-main-2 btn-round-full mt-3">Make an Appoinment<i class="icofont-simple-right ml-2  "></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section doctor-qualification gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h3>My Educational Qualifications</h3>
                        <div class="divider my-4"></div>
                        <h4 class="mb-3 title-color"><?php echo $dataofdoctor['education'] ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section doctor-skills">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="sidebar-widget  gray-bg p-4">
                        <h5 class="mb-4">Schedule of <?php echo $dataofdoctor['doctorName'] ?></h5>

                        <ul class="list-unstyled lh-35">
                            <?php
                            $selectschedule = "SELECT * from schedule s,doctor d where s.doctorId=d.doctorId and d.doctorId=$doctorIdToDetail";
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
                        <div class="sidebar-contatct-info mt-4">
                            <p class="mb-0">Need Urgent Help?</p>
                            <h3 class="text-color-2">09123456789</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
include('footer.php');
?>