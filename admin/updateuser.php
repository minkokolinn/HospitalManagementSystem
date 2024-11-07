<?php
include("header.php");
include("../connect.php");
if (isset($_REQUEST['userIdToUpdate'])) {
    $userIdToUpdate = $_REQUEST['userIdToUpdate'];

    $selectuser = "SELECT * from user where userId=$userIdToUpdate";
    $runselectuser = $connection->query($selectuser);
    $dataofuser = $runselectuser->fetch_array(MYSQLI_ASSOC);
    $name = $dataofuser['userName'];
    $email = $dataofuser['userEmail'];
    $oldpasswordhash = $dataofuser['userPassword'];
    $phone = $dataofuser['userPhone'];
    $address = $dataofuser['userAddress'];
    $nrc = $dataofuser['userNrc'];
    $note = $dataofuser['userNote'];
} else {
    echo "<script>alert('Invalid User ID')</script>";
    echo "<script>location='userlist.php'</script>";
}
if (isset($_POST['btnUpdate'])) {
    $nowoldpass=$_POST['tfUserPass'];
    if (password_verify($nowoldpass,$oldpasswordhash)) {
        $hashedpass=password_hash($_POST['tfUserCPass'],PASSWORD_DEFAULT);
        $updatequery="UPDATE user set userName='".$_POST['tfUserName']."',
                    userEmail='".$_POST['tfUserEmail']."',userPassword='$hashedpass',
                    userPhone='".$_POST['tfUserPhone']."',userAddress='".$_POST['tfUserAddress']."',
                    userNrc='".$_POST['tfUserNrc']."',userNote='".$_POST['tfUserNote']."' where
                    userId=$userIdToUpdate";       
        $runupdatequery=$connection->query($updatequery);
        if ($runupdatequery) {
            echo "<script>alert('Successfully updated an user account')</script>";
            echo "<script>window.location='userlist.php'</script>";
        }else{
            if($connection->errno==1062){
                echo "<script>alert('An account with this email already existed. Login failed and try again with another email')</script>";
            }else{
                echo "<script>alert('Insert query failed!')</script>";  
            }
        }
    }else{
        echo "<script>alert('Wrong Old Password! Update failed.')</script>";
    }
}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-5">
            <h4 class="mt-4">Update User Info</h4>
            <div class="card mb-4 col-sm-10">
                <div class="card-body">
                    <form method="post" class="mt-2" enctype="multipart/form-data">
                    <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfUserName" value="<?php echo $name; ?>" placeholder="Name" autocomplete="off" required />
                            <label for="inputName">Name</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputEmail" type="email" name="tfUserEmail" value="<?php echo $email; ?>" placeholder="Email" autocomplete="off" required />
                            <label for="inputEmail">Email address</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPassword" type="password" name="tfUserPass" placeholder="Password" required />
                            <label for="inputPassword">Old Password</label>
                            <span class="form-text">If you dont't know old password, you cannot update new password.<br>If you don't prefer to change password, retype old password</span>                            
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPassword" type="password" name="tfUserCPass" placeholder="Confirm Password" required />
                            <label for="inputPassword">New Password</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPhone" type="number" name="tfUserPhone" value="<?php echo $phone; ?>" placeholder="Phone" autocomplete="off" required />
                            <label for="inputPhone">Phone</label>
                        </div>
                        <div class="form-floating mb-2">
                            <textarea class="form-control" placeholder="Address" id="inputAddress" name="tfUserAddress" style="height: 100px" required><?php echo $address ?></textarea>
                            <label for="inputAddress">Address</label>
                        </div>
                        <div class="form-floating mt-2 mb-2">
                            <input class="form-control" id="inputNrc" type="text" name="tfUserNrc" value="<?php echo $nrc ?>" placeholder="NRC or Passport" autocomplete="off" required />
                            <label for="inputNrc">NRC or Passport</label>
                        </div>
                        <div class="form-floating mb-2">
                            <textarea class="form-control" placeholder="Note (any medical notice related to this user)" id="inputNote" name="tfUserNote" style="height: 150px"><?php echo $note; ?></textarea>
                            <label for="inputNote">Note (any medical notice related to this user)</label>
                        </div>
                        <div class="form-group">
                            <a href="userlist.php" class="btn btn-secondary">Back</a>
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