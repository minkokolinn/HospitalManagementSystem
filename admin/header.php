<?php
session_start();
include('../connect.php');
if (isset($_SESSION['loginid'])) {
    $loginid = $_SESSION['loginid'];
    $logintype = $_SESSION['logintype'];

    if ($logintype == "admin") {
        $selectadmin = "SELECT * from admin where adminId=$loginid";
        $runselectadmin = $connection->query($selectadmin);
        $dataofadmin = $runselectadmin->fetch_array();
        $adminemail = $dataofadmin['adminEmail'];
        $admintype = $dataofadmin['adminType'];
    } else if ($logintype == "staff") {
        $selectstaff = "SELECT * from staff where staffId=$loginid";
        $runselectstaff = $connection->query($selectstaff);
        $dataofstaff = $runselectstaff->fetch_array();
        $staffemail = $dataofstaff['staffEmail'];
    } else if ($logintype == "doctor") {
        $selectdoctor = "SELECT * from doctor where doctorId=$loginid";
        $runselectdoctor = $connection->query($selectdoctor);
        $dataofdoctor = $runselectdoctor->fetch_array();
        $doctoremail = $dataofdoctor['doctorEmail'];
    } else {
    }

    $ctSB=$connection->query("SELECT * from bookingservice where status=0");
    $countSB=$ctSB->num_rows;


    $ctOM=$connection->query("SELECT * from ordermed where deliveredStatus=0");
    $countOM=$ctOM->num_rows;

} else {
    echo "<script>alert('Access denied')</script>";
    echo "<script>location='index.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="img/admin_tab_icon.png">
    <title>HMS Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Admin Panel</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <h5 style="color:white;">
                    <?php
                    if ($logintype == "admin") {
                        if ($admintype == "master") {
                            echo "$adminemail ( Admin - master )";
                        } else {
                            echo "$adminemail ( Admin )";
                        }
                    } else if ($logintype == "staff") {
                        echo "$staffemail (Staff)";
                    } else if ($logintype == "doctor") {
                        echo "$doctoremail (Doctor)";
                    } else {
                    }

                    ?>
                </h5>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="home.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Human Resource</div>
                        <?php
                        if ($logintype == "admin") {
                            if ($admintype == "master") {
                                echo "
                                <a class='nav-link' href='adminlist.php'>
                                <div class='sb-nav-link-icon'><i class='fas fa-user-shield'></i></div>
                                Admin
                                </a>
                                ";
                            }
                            echo "
                            <a class='nav-link' href='stafflist.php'>
                                <div class='sb-nav-link-icon'><i class='fas fa-user-cog'></i></div>
                                Staff
                            </a>
                            <a class='nav-link' href='doctorlist.php'>
                                <div class='sb-nav-link-icon'><i class='fas fa-user-md'></i></div>
                                Doctor
                            </a>
                            ";
                        }
                        ?>

                        <a class="nav-link" href="userlist.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-hospital-user"></i></div>
                            Hospital User
                        </a>

                        <a class="nav-link" href="schedule.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                            Schedule
                        </a>

                        <?php
                        if ($logintype == "admin") {
                            echo "
                            <div class='sb-sidenav-menu-heading'>Other</div>
                            <a class='nav-link' href='speciality.php'>
                                <div class='sb-nav-link-icon'><i class='fas fa-user-md'></i></div>
                                Speciality
                            </a>
                            ";
                        }
                        if ($logintype == "doctor") {
                            echo "
                            <div class='sb-sidenav-menu-heading'>Other</div>
                            <a class='nav-link' href='article.php'>
                                <div class='sb-nav-link-icon'><i class='fas fa-newspaper'></i></div>
                                Article
                            </a>

                            <div class='sb-sidenav-menu-heading'>Appointment</div>
                                <a class='nav-link' href='appt.php'>
                                    <div class='sb-nav-link-icon'><i class='far fa-calendar-check'></i></div>
                                    Manage Appointment
                                </a>
                            ";
                        }
                        ?>

                        <!-- <div class="sb-sidenav-menu-heading">Service</div>
                        <a class='nav-link collapsed' href='#' data-bs-toggle='collapse' data-bs-target='#collapseBook' aria-expanded='false' aria-controls='collapseBook'>
                            <div class='sb-nav-link-icon'><i class='fas fa-book'></i></div>
                            Book
                            <div class='sb-sidenav-collapse-arrow'><i class='fas fa-angle-down'></i></div>
                        </a>
                        <div class='collapse' id='collapseBook' aria-labelledby='headingOne' data-bs-parent='#sidenavAccordion'>
                            <nav class='sb-sidenav-menu-nested nav'>
                                <a class='nav-link' href='addbook.php'>Add Book</a>
                                <a class='nav-link' href='booklist.php'>Book List</a>
                                <a class='nav-link' href='bookcategory.php'>Book Category</a>
                            </nav>
                        </div> -->



                        <?php
                        if ($logintype == "staff") {
                            echo
                            "
                            <div class='sb-sidenav-menu-heading'>Service</div>
                                <a class='nav-link' href='adminlist.php' data-bs-toggle='collapse' data-bs-target='#collapseService' aria-expanded='false' aria-controls='collapseService'>
                                <div class='sb-nav-link-icon'><i class='fas fa-user-shield'></i></div>
                                Manage Service
                                </a>
                                <div class='collapse' id='collapseService' aria-labelledby='headingOne' data-bs-parent='#sidenavAccordion'>
                                    <nav class='sb-sidenav-menu-nested nav'>
                                        <a class='nav-link' href='serviceadd.php'>Add Service</a>
                                        <a class='nav-link' href='servicelist.php'>View Service</a>
                                        
                                    </nav>
                                </div>
                                <a class='nav-link' href='bookingservice.php'>
                                <div class='sb-nav-link-icon'><i class='fas fa-file-alt'></i></div>
                                Manage Service Booking<span class='badge bg-success'>$countSB</span>
                                </a>


                            <div class='sb-sidenav-menu-heading'>Room</div>
                                <a class='nav-link' href='adminlist.php' data-bs-toggle='collapse' data-bs-target='#collapseRoom' aria-expanded='false' aria-controls='collapseService'>
                                <div class='sb-nav-link-icon'><i class='fas fa-hospital'></i></div>
                                Manage Room
                                </a>
                                <div class='collapse' id='collapseRoom' aria-labelledby='headingOne' data-bs-parent='#sidenavAccordion'>
                                    <nav class='sb-sidenav-menu-nested nav'>
                                        <a class='nav-link' href='roomtypeadd.php'>Add Room Type</a>
                                        <a class='nav-link' href='wardadd.php'>Add Ward</a>
                                        <a class='nav-link' href='roomlist.php'>Room List</a>
                                    </nav>
                                </div>
                                <a class='nav-link' href='bookingroom.php'>
                                <div class='sb-nav-link-icon'><i class='fas fa-file-alt'></i></div>
                                Manage Room Booking
                                </a>
                            
                            <div class='sb-sidenav-menu-heading'>Medicine</div>
                                <a class='nav-link' href='addmedicine.php'>
                                    <div class='sb-nav-link-icon'><i class='fas fa-capsules'></i></div>
                                    Manage Medicine
                                </a>
                                <a class='nav-link' href='manageorder.php'>
                                    <div class='sb-nav-link-icon'><i class='fas fa-user-md'></i></div>
                                    Manage Order Medicine<span class='badge bg-success'>$countOM</span>
                                </a>

                            <div class='sb-sidenav-menu-heading'>Appointment</div>
                                <a class='nav-link' href='appt.php'>
                                    <div class='sb-nav-link-icon'><i class='far fa-calendar-check'></i></div>
                                    Manage Appointment
                                </a>
                            ";
                        }
                        ?>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo "$logintype"; ?>
                </div>
            </nav>
        </div>