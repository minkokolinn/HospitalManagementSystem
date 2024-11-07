<?php
include("header.php");
include("../connect.php");
if (isset($_REQUEST['staffIdToUpdate'])) {
    $staffIdToUpdate = $_REQUEST['staffIdToUpdate'];

    $selectstaff = "SELECT * from staff where staffId=$staffIdToUpdate";
    $runselectstaff = $connection->query($selectstaff);
    $dataofstaff = $runselectstaff->fetch_array(MYSQLI_ASSOC);
    $name = $dataofstaff['staffName'];
    $email = $dataofstaff['staffEmail'];
    $oldpasswordhash = $dataofstaff['staffPassword'];
    $phone = $dataofstaff['staffPhone'];
    $address = $dataofstaff['staffAddress'];
} else {
    echo "<script>alert('Invalid Staff ID')</script>";
    echo "<script>location='stafflist.php'</script>";
}
if (isset($_POST['btnUpdate'])) {
    $nowoldpass=$_POST['tfStaffPass'];
    if (password_verify($nowoldpass,$oldpasswordhash)) {
        $hashedpass=password_hash($_POST['tfStaffCPass'],PASSWORD_DEFAULT);
        $updatequery="UPDATE staff set staffName='".$_POST['tfStaffName']."',
                    staffEmail='".$_POST['tfStaffEmail']."',staffPassword='$hashedpass',
                    staffPhone='".$_POST['tfStaffPhone']."',staffAddress='".$_POST['tfStaffAddress']."'
                    where staffId=$staffIdToUpdate";
        $runupdatequery=$connection->query($updatequery);
        if ($runupdatequery) {
            echo "<script>alert('Successfully updated an staff account')</script>";
            echo "<script>window.location='stafflist.php'</script>";
        }else{
            if($connection->errno==1062){
                echo "<script>alert('An account with this email already existed. Login failed and try again with another email')</script>";
            }else{
                echo "<script>alert('Insert query failed!')</script>";  
            }
        }
    }else{
        echo "<script>alert('Wrong Old Password!. Update Failed')</script>";
    }
}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-5">
            <h4 class="mt-4">Update Staff Info</h4>
            <div class="card mb-4 col-sm-10">
                <div class="card-body">
                    <form method="post" class="mt-2" enctype="multipart/form-data">
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfStaffName" value="<?php echo $name; ?>" placeholder="Name" autocomplete="off" required />
                            <label for="inputName">Name</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputEmail" type="email" name="tfStaffEmail" value="<?php echo $email; ?>" placeholder="Email" autocomplete="off" required />
                            <label for="inputEmail">Email address</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPassword" type="password" name="tfStaffPass" placeholder="Password" required />
                            <label for="inputPassword">Old Password</label>
                            <span class="form-text">If you dont't know old password, you cannot update new password.<br>If you don't prefer to change password, retype old password</span>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPassword" type="password" name="tfStaffCPass" placeholder="Confirm Password" required />
                            <label for="inputPassword">New Password</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPhone" type="number" name="tfStaffPhone" value="<?php echo $phone; ?>" placeholder="Phone" autocomplete="off" required />
                            <label for="inputPhone">Phone</label>
                        </div>
                        <div class="form-floating mb-2">
                            <textarea class="form-control" placeholder="Address" id="inputAddress" name="tfStaffAddress" style="height: 130px"><?php echo $address; ?></textarea>
                            <label for="inputAddress">Address</label>
                        </div>
                        <div class="form-group">
                            <a href="stafflist.php" class="btn btn-secondary">Back</a>
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