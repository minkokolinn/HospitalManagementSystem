<?php
include('header.php');
include('connect.php');
?>
<div id="site-start-section">
    <section class="page-title bg-1">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center">
                        <h1 class="text-capitalize mb-5 text-lg">Availabale Room Type and Rate</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section appoinment">
        <?php
        $select = "SELECT * from roomtype";
        $runselect = $connection->query($select);
        $dataofroomtype = $runselect->fetch_all(MYSQLI_ASSOC);
        foreach ($dataofroomtype as $eachdata) {
            $img = $eachdata['rtImg'];
            $name = $eachdata['rtName'];
            $size = $eachdata['rtSize'];
            $rate = $eachdata['rtRate'];
            $faclist = $eachdata['rtFaci'];
            echo "
            <div class='container mb-5'>
                <div class='row align-items-center'>
                    <div class='col-lg-6 '>
                        <div class='appoinment-content'>
                            <img src='admin/$img' alt='' class='img-fluid'>
                        </div>
                    </div>
                    <div class='col-lg-6 col-md-10 '>
                        <div class='appoinment-wrap mt-5 mt-lg-0'>
                            <h2 class='mb-2 title-color'>$name</h2>
                            <p class='mb-2'><i class='icofont-hospital mr-2' style='font-size:20px; color:red;'></i>Space - $size sqft</p>
                            ";
                $faclistlist = explode('||', $faclist);
                    foreach ($faclistlist as $fac) {
                        if ($fac != "") {
                            echo "<p class=''><i class='icofont-check mr-2' style='font-size:26px; color:red;'></i>$fac</p>";
                        }
                    }
                echo"
                    <a href='bookroom.php'><button class='btn btn-primary' style='font-size:18px;'>$rate MMK</button></a>            
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            ";
        }
        ?>
    </section>

</div>
<?php
include('footer.php');
?>