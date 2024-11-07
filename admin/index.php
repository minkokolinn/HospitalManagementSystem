<?php
session_start();
include('../connect.php');
if (isset($_SESSION['loginid'])) {
    header("Location: home.php");
}
if (isset($_POST['btnAdminLogin'])) {
    $loginType = $_POST['loginType'];

    $adminEmail = $_POST['tfAdminEmail'];
    $adminPassword = $_POST['tfAdminPass'];
    if ($loginType == "admin") {
        $selectadmin = "SELECT * from admin where adminEmail='$adminEmail'";
        $runselectadmin = $connection->query($selectadmin);
        if ($runselectadmin->num_rows == 1) {
            $dataofadmin = $runselectadmin->fetch_array();
            if (password_verify($adminPassword, $dataofadmin['adminPassword'])) {
                $_SESSION['loginid'] = $dataofadmin['adminId'];
                $_SESSION['logintype'] = $loginType;
                echo "<script>alert('Sucessful login as Admin')</script>";
                echo "<script>location='home.php'</script>";
            } else {
                echo "<script>alert('Invalid Password...')</script>";
            }
        } else {
            echo "<script>alert('Invalid login! Wrong Email...')</script>";
        }
    } else if ($loginType == "staff") {
        $selectadmin = "SELECT * from staff where staffEmail='$adminEmail'";
        $runselectadmin = $connection->query($selectadmin);
        if ($runselectadmin->num_rows == 1) {
            $dataofadmin = $runselectadmin->fetch_array();
            if ($dataofadmin['reqStatus'] == 1) {
                if (password_verify($adminPassword, $dataofadmin['staffPassword'])) {
                    $_SESSION['loginid'] = $dataofadmin['staffId'];
                    $_SESSION['logintype'] = $loginType;
                    echo "<script>alert('Sucessful login as Staff')</script>";
                    echo "<script>location='home.php'</script>";
                } else {
                    echo "<script>alert('Invalid Password...')</script>";
                }
            } else {
                echo "<script>alert('In progress. Your account is still in requesting stage. Contact admin team to get accepted.')</script>";
            }
        } else {
            echo "<script>alert('Invalid login! Wrong Email...')</script>";
        }
    } else if ($loginType == "doctor") {
        $selectdoctor = "SELECT * from doctor where doctorEmail='$adminEmail'";
        $runselectdoctor = $connection->query($selectdoctor);
        if ($runselectdoctor->num_rows == 1) {
            $dataofdoctor = $runselectdoctor->fetch_array();
            if (password_verify($adminPassword, $dataofdoctor['doctorPassword'])) {
                $_SESSION['loginid'] = $dataofdoctor['doctorId'];
                $_SESSION['logintype'] = $loginType;
                echo "<script>alert('Sucessful login as Doctor')</script>";
                echo "<script>location='home.php'</script>";
            } else {
                echo "<script>alert('Invalid Password...')</script>";
            }
        } else {
            echo "<script>alert('Invalid login! Wrong Email...')</script>";
        }
    }
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
    <title>Login - HMS Administration</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                    <p style="margin-top:-20px;" class="text-muted text-center">( Admin Panel )</p>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" name="tfAdminEmail" autocomplete="off" required />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="tfAdminPass" required />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <label class="form-text">Login as &nbsp;&nbsp;&nbsp;</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="loginType" id="flexRadioDefault1" value="admin" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Admin
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="loginType" id="flexRadioDefault2" value="staff">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Staff
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="loginType" id="flexRadioDefault3" value="doctor">
                                            <label class="form-check-label" for="flexRadioDefault3">
                                                Doctor
                                            </label>
                                        </div>
                                        <br><br>
                                        <div class="d-flex mb-3 justify-content-end">
                                            <input type="submit" class="btn btn-primary col-4" value="Login" name="btnAdminLogin">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="apregister.php">Sign up a staff account!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-5">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Note : You cannot create admin and doctor accounts via this registration form. To get these account types, contact admin team.</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>