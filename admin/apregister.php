<?php
include('../connect.php');
if (isset($_POST['btnCreateStaff'])) {
    if ($_POST['tfStaffPass']==$_POST['tfStaffCPass']) {
        $hashedpass=password_hash($_POST['tfStaffPass'],PASSWORD_DEFAULT);
        $insertquery="INSERT into staff(staffName,staffEmail,staffPassword,staffPhone,staffAddress,reqStatus) values
                    ('".$_POST['tfStaffName']."','".$_POST['tfStaffEmail']."',
                    '$hashedpass','".$_POST['tfStaffPhone']."','".$_POST['tfStaffAddress']."',FALSE)";
        $runinsert=$connection->query($insertquery);
        if ($runinsert) {
            echo "<script>alert('Requested an staff account. But you cannot access it unless admin accepts')</script>";
            echo "<script>window.location='index.php'</script>";
        }else{
            if($connection->errno==1062){
                echo "<script>alert('An account with this email already existed. Login failed and try again with another email')</script>";
            }else{
                echo "<script>alert('Insert query failed!')</script>";  
            }
        }
    }else{
        echo "<script>alert('Password and Confirm Password must be the same...')</script>"; 
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
                        <div class="col-lg-8">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Staff Registration</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-floating mb-2">
                                            <input class="form-control" id="inputName" type="text" name="tfStaffName" placeholder="Name" autocomplete="off" required />
                                            <label for="inputName">Name</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input class="form-control" id="inputEmail" type="email" name="tfStaffEmail" placeholder="Email" autocomplete="off" required />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input class="form-control" id="inputPassword" type="password" name="tfStaffPass" placeholder="Password" required />
                                            <label for="inputPassword">Password</label>
                                            <span class="form-text">Password must be greater than 8 characters</span>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input class="form-control" id="inputPassword" type="password" name="tfStaffCPass" placeholder="Confirm Password" required />
                                            <label for="inputPassword">Confirm Password</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input class="form-control" id="inputPhone" type="number" name="tfStaffPhone" placeholder="Phone" autocomplete="off" required />
                                            <label for="inputPhone">Phone</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <textarea class="form-control" placeholder="Address" id="inputAddress" name="tfStaffAddress" style="height: 130px"></textarea>
                                            <label for="inputAddress">Address</label>
                                        </div>
                                        <div class="d-flex justify-content-end mt-4">
                                            <a href="../admin/" class="btn btn-secondary mx-3">Back</a>
                                            <button type="submit" name="btnCreateStaff" class="btn btn-primary">Create</button>
                                        </div>
                                    </form>
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