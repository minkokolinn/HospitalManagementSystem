<?php
include('header.php');
include('../connect.php');
if (isset($_POST['btnCreateUser'])) {
    if ($_POST['tfUserPass'] == $_POST['tfUserCPass']) {
        $hashedpass = password_hash($_POST['tfUserPass'], PASSWORD_DEFAULT);
        $insertquery = "INSERT into user(userName,userEmail,userPassword,userPhone,userAddress,userDob,userBloodType,userNrc,userNote) values
                    ('" . $_POST['tfUserName'] . "','" . $_POST['tfUserEmail'] . "','$hashedpass',
                    '" . $_POST['tfUserPhone'] . "','" . $_POST['tfUserAddress'] . "','" . $_POST['tfUserDob'] . "',
                    '" . $_POST['tfUserBt'] . "','" . $_POST['tfUserNrc'] . "','" . $_POST['tfUserNote'] . "')";
        $runinsert = $connection->query($insertquery);
        if ($runinsert) {
            echo "<script>alert('Successfully inserted an user account')</script>";
            echo "<script>window.location='userlist.php'</script>";
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
if (isset($_GET['userIdToDelete'])) {
    echo "<script>
			var x=confirm('Are you sure to delete this user account?');
			if(x==true){
				location='deleteuser.php?userIdToDelete=" . $_GET['userIdToDelete'] . "';
			}else{
				location='userlist.php';
			}
		</script>";
}
if (isset($_GET['userIdToDetail'])) {
    $userIdToDetail = $_GET['userIdToDetail'];
    $select = "SELECT * from user where userId=$userIdToDetail";
    $runselect = $connection->query($select);
    $datauser = $runselect->fetch_array(MYSQLI_ASSOC);

    echo "<script>
    $(document).ready(function(){
        let btn=document.querySelector('#showUserDetail');
        btn.click();
    });
    </script>";
}
?>
<script>
    function goReload(){
        location='userlist.php';
    }
</script>
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
            <h4 class="mt-4">Hospital Users List</h4>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    You can view and manage user accounts' information.
                    <button id="btnShowModalDialog" class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#addNewUser">New User</button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Phone</th>
                                <th>NRC</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Phone</th>
                                <th>NRC</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $selectuser = "SELECT * from user";
                            $runselectuser = $connection->query($selectuser);
                            $countofuser = $runselectuser->num_rows;
                            if ($countofuser > 0) {
                                $dataofuser = $runselectuser->fetch_all(MYSQLI_BOTH);
                                $no = 0;
                                foreach ($dataofuser as $dataone) {
                                    $no++;
                                    $userId = $dataone['userId'];
                                    echo "<tr>";
                                    echo "<td>$no</td>";
                                    echo "<td><a href='userlist.php?userIdToDetail=$userId'>" . $dataone['userName'] . "</a><a href='' data-bs-toggle='modal' data-bs-target='#userDetailModal' id='showUserDetail' style='display:none;'></a></td>";
                                    echo "<td><u>" . $dataone['userEmail'] . "</u></td>";
                                    echo "<td>" . $dataone['userPhone'] . "</td>";
                                    echo "<td>" . $dataone['userNrc'] . "</td>";
                                    echo "<td><a href='userlist.php?userIdToDelete=$userId' class='actionlink'><i class='fas fa-trash'></i>&nbsp;&nbspDelete</a>
                                        <br>
                                        <a href='updateuser.php?userIdToUpdate=$userId' class='actionlink'><i class='fas fa-edit'></i>&nbsp;&nbspEdit</a>
                                        </td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- User Detail -->
    <form method="post">
        <div class="modal fade" id="userDetailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">User Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="goReload()"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <tr>
                                <td>Name - </td>
                                <td><?php echo $datauser['userName']; ?></td>
                            </tr>
                            <tr>
                                <td>Email - </td>
                                <td><?php echo $datauser['userEmail']; ?></td>
                            </tr>
                            <tr>
                                <td>Phone - </td>
                                <td><?php echo $datauser['userPhone']; ?></td>
                            </tr>
                            <tr>
                                <td>Adderss - </td>
                                <td><?php echo $datauser['userAddress']; ?></td>
                            </tr>
                            <tr>
                                <td>Date of Birth - </td>
                                <td><?php echo $datauser['userDob']; ?></td>
                            </tr>
                            <tr>
                                <td>Blodd Type - </td>
                                <td><?php echo $datauser['userBloodType'] ?></td>
                            </tr>
                            <tr>
                                <td>NRC - </td>
                                <td><?php echo $datauser['userNrc']; ?></td>
                            </tr>
                            <tr>
                                <td>Note - </td>
                                <td><?php echo $datauser['userNote']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="submit" name="btnCreateWard" class="btn btn-primary">Create</button> -->
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- -------------- -->

    <!-- Modal dialog form -->
    <form method="post">
        <div class="modal fade" id="addNewUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfUserName" placeholder="Name" autocomplete="off" required />
                            <label for="inputName">Name</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputEmail" type="email" name="tfUserEmail" placeholder="Email" autocomplete="off" required />
                            <label for="inputEmail">Email address</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPassword" type="password" name="tfUserPass" placeholder="Password" required />
                            <label for="inputPassword">Password</label>
                            <span class="form-text">Password must be greater than 8 characters</span>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPassword" type="password" name="tfUserCPass" placeholder="Confirm Password" required />
                            <label for="inputPassword">Confirm Password</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPhone" type="number" name="tfUserPhone" placeholder="Phone" autocomplete="off" required />
                            <label for="inputPhone">Phone</label>
                        </div>
                        <div class="form-floating mb-2">
                            <textarea class="form-control" placeholder="Address" id="inputAddress" name="tfUserAddress" style="height: 100px" required></textarea>
                            <label for="inputAddress">Address</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputDob" type="date" name="tfUserDob" placeholder="Date of birth" required />
                            <label for="inputDob">Date of birth</label>
                        </div>
                        <!-- <div class="form-floating mb-2"> -->
                        <label class="form-text">Blood Type : &nbsp;&nbsp;</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tfUserBt" id="inlineRadio1" value="A" checked />
                            <label class="form-check-label" for="inlineRadio1">A</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tfUserBt" id="inlineRadio2" value="B" />
                            <label class="form-check-label" for="inlineRadio2">B</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tfUserBt" id="inlineRadio3" value="AB" />
                            <label class="form-check-label" for="inlineRadio3">AB</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tfUserBt" id="inlineRadio4" value="O" />
                            <label class="form-check-label" for="inlineRadio4">O</label>
                        </div>
                        <!-- </div> -->
                        <div class="form-floating mt-2 mb-2">
                            <input class="form-control" id="inputNrc" type="text" name="tfUserNrc" placeholder="NRC or Passport" autocomplete="off" required />
                            <label for="inputNrc">NRC or Passport</label>
                        </div>
                        <div class="form-floating mb-2">
                            <textarea class="form-control" placeholder="Note (any medical notice related to this user)" id="inputNote" name="tfUserNote" style="height: 150px"></textarea>
                            <label for="inputNote">Note (any medical notice related to this user)</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Clear</button>
                        <button type="submit" name="btnCreateUser" class="btn btn-primary">Create</button>
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