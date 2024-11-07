<?php
include('header.php');
include('../connect.php');
if (isset($_POST['btnCreateStaff'])) {
    if ($_POST['tfStaffPass']==$_POST['tfStaffCPass']) {
        $hashedpass=password_hash($_POST['tfStaffPass'],PASSWORD_DEFAULT);
        $insertquery="INSERT into staff(staffName,staffEmail,staffPassword,staffPhone,staffAddress,reqStatus) values
                    ('".$_POST['tfStaffName']."','".$_POST['tfStaffEmail']."',
                    '$hashedpass','".$_POST['tfStaffPhone']."','".$_POST['tfStaffAddress']."',TRUE)";
        $runinsert=$connection->query($insertquery);
        if ($runinsert) {
            echo "<script>alert('Successfully inserted an staff account')</script>";
            echo "<script>window.location='stafflist.php'</script>";
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
if (isset($_GET['staffIdToDelete'])) {
		echo "<script>
			var x=confirm('Are you sure to delete this staff account?');
			if(x==true){
				location='deletestaff.php?staffIdToDelete=".$_GET['staffIdToDelete']."';
			}else{
				location='stafflist.php';
			}
		</script>";
}
if (isset($_GET['staffIdToAccept'])) {
    $acceptquery="UPDATE staff set reqStatus=TRUE where staffId=".$_GET['staffIdToAccept'];
    $runacceptquery=$connection->query($acceptquery);
    if ($runacceptquery) {
        echo "<script>location='stafflist.php'</script>";
    }else{
        echo "<script>alert('Accept failed...')</script>"; 
    }
}
?>
<style>
    .actionlink {
        text-decoration: none;
    }

    .actionlink:hover {
        text-decoration: underline;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4">Staff List</h4>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    You can view and manage staff accounts' information.
                    <button id="btnShowModalDialog" class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#addNewStaff">New Staff</button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Staff Name</th>
                                <th>Staff Email</th>
                                <th>Password</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Staff Name</th>
                                <th>Staff Email</th>
                                <th>Password</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $selectstaff = "SELECT * from staff";
                            $runselectstaff = $connection->query($selectstaff);
                            $countofstaff = $runselectstaff->num_rows;
                            if ($countofstaff > 0) {
                                $dataofstaff = $runselectstaff->fetch_all(MYSQLI_BOTH);
                                $no = 0;
                                foreach ($dataofstaff as $dataone) {
                                    $no++;
                                    $staffId = $dataone['staffId'];
                                    echo "<tr>";
                                    echo "<td>$no</td>";
                                    echo "<td>" . $dataone['staffName'] . "</td>";
                                    echo "<td><u>" . $dataone['staffEmail'] . "</u></td>";
                                    echo "<td>&bull;&bull;&bull;&bull;&bull;&bull;</td>";
                                    echo "<td>" . $dataone['staffPhone'] . "</td>";
                                    echo "<td>" . $dataone['staffAddress'] . "</td>";
                                    if ($dataone['reqStatus'] == 1) {
                                        echo "<td>Accepted</td>";
                                    } else {
                                        echo "<td style='color:green;'>Requested</td>";
                                    }
                                    echo "<td>";
                                    if ($dataone['reqStatus'] != 1) {
                                        echo "<a href='stafflist.php?staffIdToAccept=$staffId' class='btn btn-success mx-1'>Accept</a>
                                        <a href='deletestaff.php?staffIdToDelete=$staffId' class='btn btn-danger'>Deny</a>";
                                    } else {
                                        echo "<a href='stafflist.php?staffIdToDelete=$staffId' class='actionlink'><i class='fas fa-trash'></i>&nbsp;&nbspDelete</a>
                                        <br>
                                        <a href='updatestaff.php?staffIdToUpdate=$staffId' class='actionlink'><i class='fas fa-edit'></i>&nbsp;&nbspEdit</a>
                                        ";
                                    }
                                    echo "</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>


    <!-- Modal dialog form -->
    <form method="post">
        <div class="modal fade" id="addNewStaff" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Staff</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Clear</button>
                        <button type="submit" name="btnCreateStaff" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- -------------- -->
</div>
<?php
include('footer.php');
?>