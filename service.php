<?php
include("header.php");
include("connect.php");
?>
<style>
    .wrappingDesp {
        height: 90px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .makeline {
        display: -webkit-box;
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
</style>
<section class="page-title bg-1" id="site-start-section">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block text-center">
                    <h1 class="text-capitalize mb-5 text-lg">Available Services from hospital</h1>

                    <!-- <ul class="list-inline breadcumb-nav">
            <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
            <li class="list-inline-item"><span class="text-white">/</span></li>
            <li class="list-inline-item"><a href="#" class="text-white-50">All Doctors</a></li>
          </ul> -->
                </div>
            </div>
        </div>
    </div>
</section>


<!-- portfolio -->
<section class="section doctors">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="section-title">
                    <h2>Services</h2>
                    <div class="divider mx-auto my-4"></div>
                    <p>We provide a wide range of international and local services related to following types like medical, patient and so on. You can probably book some medical services directly from this platform. You will be announed if your booking is confirmed. <u>Check it out in your profile!</u></p>
                </div>
            </div>
        </div>

        <div class="col-12 text-center  mb-5">
            <div class="btn-group btn-group-toggle " data-toggle="buttons">
                <label class="btn active ">
                    <input type="radio" name="shuffle-filter" value="all" checked="checked" />All Services
                </label>



                <?php
                $selectst = "SELECT * from servicetype";
                $runselectst = $connection->query($selectst);
                $dataofst = $runselectst->fetch_all(MYSQLI_ASSOC);
                foreach ($dataofst as $dataone) {
                    $servicetypeid = $dataone['stId'];
                    $servicetype = $dataone['stServicetype'];
                    echo "<label class='btn'>";
                    echo "<input type='radio' name='shuffle-filter' value='$servicetypeid' />$servicetype";
                    echo "</label>";
                }
                ?>
            </div>
        </div>

        <div class="row shuffle-wrapper">
            <?php
            $select = "SELECT s.*,st.* from service s,servicetype st where s.stId=st.stId";
            $runselect = $connection->query($select);
            $countofservice = $runselect->num_rows;
            if ($countofservice > 0) {
                $dataofservice = $runselect->fetch_all(MYSQLI_ASSOC);
                foreach ($dataofservice as $dataeachservice) {
                    $servicetypeId = $dataeachservice['stId'];
                    $serviceImg = $dataeachservice['serviceImg'];
                    $serviceTitle = $dataeachservice['serviceName'];
                    $serviceDesp = $dataeachservice['serviceDescription'];
                    $servicetype = $dataeachservice['stServicetype'];
                    $serviceIdToDetail = $dataeachservice['serviceId'];
                    echo "
                    <div class='col-lg-4 col-md-6 mb-4 shuffle-item space_left' data-groups='[&quot;$servicetypeId&quot;]'>
                    <div class='department-block mb-5 mb-lg-0 clearfix'>
                        <div alt='' style='width:100%; height:250px; background-image:url(admin/$serviceImg); background-size:contain; background-repeat:no-repeat;'></div>
                        <div class='content'>
                            <h5 class='mt-4 mb-2 title-color'>$serviceTitle</h5>
                            <p class='mb-4 makeline'>$serviceDesp</p>
                            <h3><span class='badge badge-info'>$servicetype</span></h3>
                            <a href='servicedetail.php?serviceIdToDetail=$serviceIdToDetail' class='read-more'>Learn More <i class='icofont-simple-right ml-2'></i></a>
                        </div>
                    </div>
                    </div><br>
                    ";
                }
            }
            ?>
        </div>
    </div>
</section>
<!-- /portfolio -->
<section class="section cta-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="cta-content">
                    <div class="divider mb-4"></div>
                    <h2 class="mb-5 text-lg">We are pleased to offer you the <span class="title-color">chance to have the healthy</span></h2>
                    <a href="appoinment.html" class="btn btn-main-2 btn-round-full">Get appoinment<i class="icofont-simple-right  ml-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include("footer.php");
?>