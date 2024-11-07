<?php
include('header.php');
include('../connect.php');
if (isset($_POST['btnCreateAdmin'])) {
    if ($_POST['tfAdminPass'] == $_POST['tfAdminCPass']) {
        $hashedadminpass = password_hash($_POST['tfAdminPass'], PASSWORD_DEFAULT);
        $insertquery = "INSERT into admin(adminName,adminEmail,adminPassword,adminPhone) values
                    ('" . $_POST['tfAdminName'] . "','" . $_POST['tfAdminEmail'] . "',
                    '$hashedadminpass','" . $_POST['tfAdminPhone'] . "')";
        $runinsert = $connection->query($insertquery);
        if ($runinsert) {
            echo "<script>alert('Successfully inserted an admin account')</script>";
            echo "<script>window.location='adminlist.php'</script>";
        } else {
            if ($connection->errno == 1062) {
                echo "<script>alert('An account with this email already existed. Login failed and try again with another email')</script>";
            } else {
                echo "<script>alert('Insert query failed!')</script>";
            }
        }
    } else {
        echo "<script>alert('Password and Confirm Password must be the same...')</script>";
    }
}
if (isset($_GET['adminIdToDelete'])) {
    echo "<script>
			var x=confirm('Are you sure to delete this admin account?');
			if(x==true){
				location='deleteadmin.php?adminIdToDelete=" . $_GET['adminIdToDelete'] . "';
			}else{
				location='adminlist.php';
			}
		</script>";
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
            <h4 class="mt-4">Admin List</h4>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    You can view and manage admin accounts' information.
                    <button id="btnShowModalDialog" class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#addNewAdmin">New Admin</button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Admin Name</th>
                                <th>Admin Email</th>
                                <th>Password</th>
                                <th>Phone</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Admin Name</th>
                                <th>Admin Email</th>
                                <th>Password</th>
                                <th>Phone</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $selectadmin = "SELECT * from admin";
                            $runselectadmin = mysqli_query($connection, $selectadmin);
                            $countofadmin = mysqli_num_rows($runselectadmin);
                            if ($countofadmin > 0) {
                                $dataofadmin = mysqli_fetch_all($runselectadmin, MYSQLI_ASSOC);
                                $no = 0;
                                foreach ($dataofadmin as $dataone) {
                                    $no++;
                                    $adminId = $dataone['adminId'];
                                    echo "<tr>";
                                    echo "<td>$no</td>";
                                    echo "<td>" . $dataone['adminName'] . "</td>";
                                    echo "<td><u>" . $dataone['adminEmail'] . "</u></td>";
                                    echo "<td>&bull;&bull;&bull;&bull;&bull;&bull;</td>";
                                    echo "<td>" . $dataone['adminPhone'] . "</td>";
                                    echo "<td>" . $dataone['adminType'] . "</td>";
                                    if ($dataone['adminType'] == "master") {
                                        echo "<td></td>";
                                    } else {
                                        echo "<td>
                                    			<a href='adminlist.php?adminIdToDelete=$adminId' class='actionlink'><i class='fas fa-trash'></i>&nbsp;&nbspDelete</a>
                                                <br>
                                                <a href='updateadmin.php?adminIdToUpdate=$adminId' class='actionlink'><i class='fas fa-edit'></i>&nbsp;&nbspEdit</a>
                                    		</td>";
                                        echo "</tr>";
                                    }
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
        <div class="modal fade" id="addNewAdmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfAdminName" placeholder="Name" autocomplete="off" required />
                            <label for="inputName">Name</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputEmail" type="email" name="tfAdminEmail" placeholder="Email" autocomplete="off" required />
                            <label for="inputEmail">Email address</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPassword" type="password" name="tfAdminPass" placeholder="Password" required />
                            <label for="inputPassword">Password</label>
                            <span class="form-text">Password must be greater than 8 characters</span>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPassword" type="password" name="tfAdminCPass" placeholder="Confirm Password" required />
                            <label for="inputPassword">Confirm Password</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPhone" type="number" name="tfAdminPhone" placeholder="Phone" autocomplete="off" required />
                            <label for="inputPhone">Phone</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Clear</button>
                        <button type="submit" name="btnCreateAdmin" class="btn btn-primary">Create</button>
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