<?php
include('header.php');
include('../connect.php');

//Get User Total
$runUTotal=$connection->query('SELECT * from user');
$countUTotal=$runUTotal->num_rows;

//Get Doctor Total
$runDTotal=$connection->query('SELECT * from doctor');
$countDTotal=$runDTotal->num_rows;

//Get Service Total
$runSTotal=$connection->query('SELECT * from service');
$countSTotal=$runSTotal->num_rows;

//Get Room Total
$runRTotal=$connection->query('SELECT * from room');
$countRTotal=$runRTotal->num_rows;

//Get Medicine Total
$runMTotal=$connection->query('SELECT * from medicine');
$countMTotal=$runMTotal->num_rows;

$today=date("Y-m-d");
//Get Appointment Today Total
$runATotal=$connection->query("SELECT * from appointment where appt_date='$today'");
$countATotal=$runATotal->num_rows;

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Statistical Analysis</li>
            </ol>
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            Total Users/Patients
                            <div class="d-block text-center my-4">
                                <h2 style="font-size: 50px;"><?php echo $countUTotal?></h2>
                            </div>
                            
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="userlist.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body">
                            Total Doctor
                            <div class="d-block text-center my-4">
                                <h2 style="font-size: 50px;"><?php echo $countDTotal; ?></h2>
                            </div>
                            
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="doctorlist.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            Total Service
                            <div class="d-block text-center my-4">
                                <h2 style="font-size: 50px;"><?php echo $countSTotal; ?></h2>
                            </div>
                            
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="servicelist.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card bg-secondary text-white mb-4">
                        <div class="card-body">
                            Total Room
                            <div class="d-block text-center my-4">
                                <h2 style="font-size: 50px;"><?php echo $countRTotal; ?></h2>
                            </div>
                            
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="roomlist.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-6">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body">
                            Total Medicine Stock
                            <div class="d-block text-center my-4">
                                <h2 style="font-size: 50px;"><?php echo $countMTotal; ?></h2>
                            </div>
                            
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="addmedicine.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card bg-dark text-white mb-4">
                        <div class="card-body">
                            Total Appointment Today
                            <div class="d-block text-center my-4">
                                <h2 style="font-size: 50px;"><?php echo $countATotal; ?></h2>
                            </div>
                            
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="appt.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Hospital Management and Appointment System</div>
            </div>
        </div>
    </footer>
</div>

<?php
include('footer.php');
?>