<?php
include("header.php");
include("../connect.php");
if (isset($_REQUEST['adminIdToUpdate'])) {
    $adminIdToUpdate = $_REQUEST['adminIdToUpdate'];

    $selectadmin = "SELECT * from admin where adminId=$adminIdToUpdate";
    $runselectadmin = $connection->query($selectadmin);
    $dataofadmin = $runselectadmin->fetch_array(MYSQLI_ASSOC);
    $name=$dataofadmin['adminName'];
    $email=$dataofadmin['adminEmail'];
    $oldpasswordhash=$dataofadmin['adminPassword'];
    $phone=$dataofadmin['adminPhone'];
} else {
    echo "<script>alert('Invalid Admin ID')</script>";
    echo "<script>location='adminlist.php'</script>";
}
if (isset($_POST['btnUpdate'])) {
    $nowoldpass=$_POST['tfAdminPass'];
    if (password_verify($nowoldpass,$oldpasswordhash)) {
        $hashedadminpass = password_hash($_POST['tfAdminCPass'], PASSWORD_DEFAULT);
        $updatequery="UPDATE admin set adminName='".$_POST['tfAdminName']."',
                    adminEmail='".$_POST['tfAdminEmail']."',adminPassword='$hashedadminpass',
                    adminPhone='".$_POST['tfAdminPhone']."' where adminId=$adminIdToUpdate";
        $runupdatequery = $connection->query($updatequery);
        if ($runupdatequery) {
            echo "<script>alert('Successfully updated an admin account')</script>";
            echo "<script>window.location='adminlist.php'</script>";
        } else {
            if ($connection->errno == 1062) {
                echo "<script>alert('An account with this email already existed. Login failed and try again with another email')</script>";
            } else {
                echo "<script>alert('Insert query failed!')</script>";
            }
        }
    }else {
        echo "<script>alert('Wrong old password! Update failed.')</script>";
    }
}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-5">
            <h4 class="mt-4">Update Admin Info</h4>
            <div class="card mb-4 col-sm-10">
                <div class="card-body">
                    <form method="post" class="mt-2" enctype="multipart/form-data">
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfAdminName" value="<?php echo $name; ?>" placeholder="Name" autocomplete="off" required />
                            <label for="inputName">Name</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputEmail" type="email" name="tfAdminEmail" value="<?php echo $email; ?>" placeholder="Email" autocomplete="off" required />
                            <label for="inputEmail">Email address</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPassword" type="password" name="tfAdminPass" placeholder="Password" required />
                            <label for="inputPassword">Old Password</label>
                            <span class="form-text">If you dont't know old password, you cannot update new password.<br>If you don't prefer to change password, retype old password</span>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPassword" type="password" name="tfAdminCPass" placeholder="Confirm Password" required />
                            <label for="inputPassword">New Password</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPhone" type="number" name="tfAdminPhone" value="<?php echo $phone; ?>" placeholder="Phone" autocomplete="off" required />
                            <label for="inputPhone">Phone</label>
                        </div>
                        <div class="form-group">
                            <a href="adminlist.php" class="btn btn-secondary">Back</a>
                            <button type="submit" name="btnUpdate" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
<?php
include("footer.php");
?>