<?php
include("header.php");
include("connect.php");
if (isset($_REQUEST["serviceIdToDetail"])) {
    $specificserviceid = $_REQUEST["serviceIdToDetail"];
    $select = "SELECT s.*,st.* from service s,servicetype st where s.stId=st.stId and s.serviceId=$specificserviceid";
    $runselect = $connection->query($select);
    $dataofservice = $runselect->fetch_array(MYSQLI_ASSOC);
    $serviceImg = $dataofservice['serviceImg'];
    $serviceTitle = $dataofservice['serviceName'];
} else {
    echo "<script>alert('Invalid service')</script>";
    echo "<script>location='service.php'</script>";
}
?>
<section class="page-title bg-1" id="site-start-section">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block text-center">
                    <h1 class="text-capitalize mb-5 text-lg"><?php echo $dataofservice['serviceName']; ?></h1>

                    <!-- <ul class="list-inline breadcumb-nav">
            <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
            <li class="list-inline-item"><span class="text-white">/</span></li>
            <li class="list-inline-item"><a href="#" class="text-white-50">Department Details</a></li>
          </ul> -->
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section department-single">
    <div class="container">
        <div class="row">
            <center>
                <div class="col-lg-8">
                    <div class="department-img">
                        <img src="<?php echo "admin/" . $serviceImg; ?>" alt="" class="img-fluid">
                    </div>
                </div>
            </center>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="department-content mt-5">
                    <h3 class="text-md"><?php echo $serviceTitle; ?></h3>
                    <div class="divider my-4"></div>
                    <button class="lead btn btn-info mb-4" style="font-size: 18px;"><?php echo $dataofservice['stServicetype']; ?></button>
                    <p><?php echo $dataofservice['serviceDescription'] ?></p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sidebar-widget schedule-widget mt-5">
                    <h5 class="mb-4">Time Schedule</h5>

                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between align-items-center">
                            <a href="#">Monday - Friday</a>
                            <span>9:00 - 17:00</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center">
                            <a href="#">Saturday</a>
                            <span>9:00 - 16:00</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center">
                            <a href="#">Sunday</a>
                            <span>Closed</span>
                        </li>
                    </ul>

                    <div class="sidebar-contatct-info mt-4">
                        <p class="mb-0">Need Urgent Help?</p>
                        <h3>+23-4565-65768</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                if ($dataofservice['sec1'] != "") {
                    $sec1Title = $dataofservice['sec1'];
                    echo "
                        <h3 class='mt-5 mb-4'>$sec1Title</h3>
                        <div class='divider my-4'></div>
                        <ul class='list-unstyled department-service'>
                        ";
                    $sec1List = explode('||', $dataofservice['sec1Desp']);
                    foreach ($sec1List as $sec1Each) {
                        if ($sec1Each != "") {
                            echo "<li><i class='icofont-check mr-2'></i>$sec1Each</li>";
                        }
                    }
                    echo "
                        </ul>
                        ";
                }

                if ($dataofservice['sec2'] != "") {
                    $sec2Title = $dataofservice['sec2'];
                    echo "
                        <h3 class='mt-5 mb-4'>$sec2Title</h3>
                        <div class='divider my-4'></div>
                        <ul class='list-unstyled department-service'>
                            ";
                    $sec2List = explode('||', $dataofservice['sec2Desp']);
                    foreach ($sec2List as $sec2Each) {
                        if ($sec2Each != "") {
                            echo "<li><i class='icofont-check mr-2'></i>$sec2Each</li>";
                        }
                    }
                    echo "
                                </ul>
                                ";
                }

                if ($dataofservice['sec3'] != "") {
                    $sec3Title = $dataofservice['sec3'];
                    echo "
                        <h3 class='mt-5 mb-4'>$sec3Title</h3>
                        <div class='divider my-4'></div>
                        <ul class='list-unstyled department-service'>";

                    $sec3List = explode('||', $dataofservice['sec3Desp']);
                    foreach ($sec3List as $sec3Each) {
                        if ($sec3Each != "") {
                            echo "<li><i class='icofont-check mr-2'></i>$sec3Each</li>";
                        }
                    }
                    echo "
                            </ul>
                            ";
                    if ($dataofservice['bookable']==1) {
                        echo "";
                    }
                    
                }
                ?>
                <?php
                $bookable=$dataofservice['bookable'];
                $cost=$dataofservice['cost'];
                if ($bookable==1) {
                    echo "<h3 class='mb-5'>Price - $cost MMK</h3>";
                    echo "<a href='bookingservice.php?serviceIdToBook=$specificserviceid' class='btn btn-main-2 btn-round-full'>Book Service<i class='icofont-simple-right ml-2  '></i></a>";
                }
                ?>
                
                
            </div>
        </div>
    </div>
</section>

<?php
include('footer.php');
?>