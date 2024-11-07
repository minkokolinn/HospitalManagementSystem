<?php
include('header.php');
include('../connect.php');
if (isset($_POST['btnCreateDoctor'])) {
    if ($_POST['tfPass'] == $_POST['tfCPass']) {
        $hashedpass = password_hash($_POST['tfPass'], PASSWORD_DEFAULT);
        $insertquery = "INSERT into doctor(doctorName,doctorEmail,doctorPassword,doctorPhone,education,introduction,specialityId) values
                    ('" . $_POST['tfName'] . "','" . $_POST['tfEmail'] . "',
                    '$hashedpass','" . $_POST['tfPhone'] . "','" . $_POST['tfEducation'] . "',
                    '" . $_POST['tfIntroduction'] . "','" . $_POST['tfSpeciality'] . "')";
        $runinsert = $connection->query($insertquery);
        if ($runinsert) {
            echo "<script>alert('Successfully inserted an doctor account')</script>";
            echo "<script>window.location='doctorlist.php'</script>";
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
if (isset($_GET['doctorIdToDelete'])) {
    echo "<script>
    	var x=confirm('Are you sure to delete this doctor account?');
    	if(x==true){
    		location='deletedoctor.php?doctorIdToDelete=" . $_GET['doctorIdToDelete'] . "';
    	}else{
    		location='doctorlist.php';
    	}
    </script>";
}
if (isset($_GET['doctorIdToSchedule'])) {
    $doctorIdToSchedule = $_GET['doctorIdToSchedule'];
    $selectdoctorname = "SELECT doctorName from doctor where doctorId=$doctorIdToSchedule";
    $runselectdoctorname = $connection->query($selectdoctorname);
    $dataofdoctorname = $runselectdoctorname->fetch_array(MYSQLI_ASSOC);
    $doctorname = $dataofdoctorname['doctorName'];
    echo "<script>
    $(document).ready(function(){
        let btnAddSchedule=document.querySelector('#addSchedule');
        btnAddSchedule.click();
    });
    </script>";

    if (isset($_POST['btnCreateSchedule'])) {
        

        if (isset($_POST['chkMon'])) {
            $valDayOfSchedule="mon";
            $valFrom=$_POST['tfMonFrom'];
            $valTo=$_POST['tfMonTo'];
            $runinsert=$connection->query("INSERT into schedule(dayOfSchedule,startTime,endTime,doctorId)
                                    values('$valDayOfSchedule','$valFrom','$valTo',$doctorIdToSchedule)");
        }

        if (isset($_POST['chkTue'])) {
            $valDayOfSchedule="tue";
            $valFrom=$_POST['tfTueFrom'];
            $valTo=$_POST['tfTueTo'];
            $runinsert=$connection->query("INSERT into schedule(dayOfSchedule,startTime,endTime,doctorId)
                                    values('$valDayOfSchedule','$valFrom','$valTo',$doctorIdToSchedule)");
        }

        if (isset($_POST['chkWed'])) {
            $valDayOfSchedule="wed";
            $valFrom=$_POST['tfWedFrom'];
            $valTo=$_POST['tfWedTo'];
            $runinsert=$connection->query("INSERT into schedule(dayOfSchedule,startTime,endTime,doctorId)
                                    values('$valDayOfSchedule','$valFrom','$valTo',$doctorIdToSchedule)");
        }

        if (isset($_POST['chkThur'])) {
            $valDayOfSchedule="thur";
            $valFrom=$_POST['tfThurFrom'];
            $valTo=$_POST['tfThurTo'];
            $runinsert=$connection->query("INSERT into schedule(dayOfSchedule,startTime,endTime,doctorId)
                                    values('$valDayOfSchedule','$valFrom','$valTo',$doctorIdToSchedule)");
        }

        if (isset($_POST['chkFri'])) {
            $valDayOfSchedule="fri";
            $valFrom=$_POST['tfFriFrom'];
            $valTo=$_POST['tfFriTo'];
            $runinsert=$connection->query("INSERT into schedule(dayOfSchedule,startTime,endTime,doctorId)
                                    values('$valDayOfSchedule','$valFrom','$valTo',$doctorIdToSchedule)");
        }

        if (isset($_POST['chkSat'])) {
            $valDayOfSchedule="sat";
            $valFrom=$_POST['tfSatFrom'];
            $valTo=$_POST['tfSatTo'];
            $runinsert=$connection->query("INSERT into schedule(dayOfSchedule,startTime,endTime,doctorId)
                                    values('$valDayOfSchedule','$valFrom','$valTo',$doctorIdToSchedule)");
        }

        if (isset($_POST['chkSun'])) {
            $valDayOfSchedule="sun";
            $valFrom=$_POST['tfSunFrom'];
            $valTo=$_POST['tfSunTo'];
            $runinsert=$connection->query("INSERT into schedule(dayOfSchedule,startTime,endTime,doctorId)
                                    values('$valDayOfSchedule','$valFrom','$valTo',$doctorIdToSchedule)");
        }
        echo "<script>alert('added schedule!')</script>";
        echo "<script>location='doctorlist.php'</script>";
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
<script>
    $(document).ready(function() {
        //Monday
        $('#tfBoxMon').attr('readonly', true);
        $('#tfBoxMon').attr('required', false);
        $('#tfBoxMon1').attr('readonly', true);
        $('#tfBoxMon1').attr('required', false);
        $('#checkMon').on('change', function() {
            const element = document.getElementById('tfBoxMon');
            if (element.readOnly) {
                $('#tfBoxMon').attr('readonly', false);
                $('#tfBoxMon').attr('required', true);
                $('#tfBoxMon1').attr('readonly', false);
                $('#tfBoxMon1').attr('required', true);
            } else {
                $('#tfBoxMon').attr('readonly', true);
                $('#tfBoxMon').attr('required', false);
                $('#tfBoxMon1').attr('readonly', true);
                $('#tfBoxMon1').attr('required', false);

                //make clear
                $('#tfBoxMon').val('');
                $('#tfBoxMon1').val('');
            }
        });
        //Tuesday
        $('#tfBoxTue').attr('readonly', true);
        $('#tfBoxTue').attr('required', false);
        $('#tfBoxTue1').attr('readonly', true);
        $('#tfBoxTue1').attr('required', false);
        $('#checkTue').on('change', function() {
            const element = document.getElementById('tfBoxTue');
            if (element.readOnly) {
                $('#tfBoxTue').attr('readonly', false);
                $('#tfBoxTue').attr('required', true);
                $('#tfBoxTue1').attr('readonly', false);
                $('#tfBoxTue1').attr('required', true);
            } else {
                $('#tfBoxTue').attr('readonly', true);
                $('#tfBoxTue').attr('required', false);
                $('#tfBoxTue1').attr('readonly', true);
                $('#tfBoxTue1').attr('required', false);
                
                //make clear
                $('#tfBoxTue').val('');
                $('#tfBoxTue1').val('');
            }
        });
        //Wednesday
        $('#tfBoxWed').attr('readonly', true);
        $('#tfBoxWed').attr('required', false);
        $('#tfBoxWed1').attr('readonly', true);
        $('#tfBoxWed1').attr('required', false);
        $('#checkWed').on('change', function() {
            const element = document.getElementById('tfBoxWed');
            if (element.readOnly) {
                $('#tfBoxWed').attr('readonly', false);
                $('#tfBoxWed').attr('required', true);
                $('#tfBoxWed1').attr('readonly', false);
                $('#tfBoxWed1').attr('required', true);
            } else {
                $('#tfBoxWed').attr('readonly', true);
                $('#tfBoxWed').attr('required', false);
                $('#tfBoxWed1').attr('readonly', true);
                $('#tfBoxWed1').attr('required', false);

                //make clear
                $('#tfBoxWed').val('');
                $('#tfBoxWed1').val('');
            }
        });
        //Thurday
        $('#tfBoxThur').attr('readonly', true);
        $('#tfBoxThur').attr('required', false);
        $('#tfBoxThur1').attr('readonly', true);
        $('#tfBoxThur1').attr('required', false);
        $('#checkThur').on('change', function() {
            const element = document.getElementById('tfBoxThur');
            if (element.readOnly) {
                $('#tfBoxThur').attr('readonly', false);
                $('#tfBoxThur').attr('required', true);
                $('#tfBoxThur1').attr('readonly', false);
                $('#tfBoxThur1').attr('required', true);
            } else {
                $('#tfBoxThur').attr('readonly', true);
                $('#tfBoxThur').attr('required', false);
                $('#tfBoxThur1').attr('readonly', true);
                $('#tfBoxThur1').attr('required', false);

                //make clear
                $('#tfBoxThur').val('');
                $('#tfBoxThur1').val('');
            }
        });
        //Friday
        $('#tfBoxFri').attr('readonly', true);
        $('#tfBoxFri').attr('required', false);
        $('#tfBoxFri1').attr('readonly', true);
        $('#tfBoxFri1').attr('required', false);
        $('#checkFri').on('change', function() {
            const element = document.getElementById('tfBoxFri');
            if (element.readOnly) {
                $('#tfBoxFri').attr('readonly', false);
                $('#tfBoxFri').attr('required', true);
                $('#tfBoxFri1').attr('readonly', false);
                $('#tfBoxFri1').attr('required', true);
            } else {
                $('#tfBoxFri').attr('readonly', true);
                $('#tfBoxFri').attr('required', false);
                $('#tfBoxFri1').attr('readonly', true);
                $('#tfBoxFri1').attr('required', false);

                //make clear
                $('#tfBoxFri').val('');
                $('#tfBoxFri1').val('');
            }
        });
        //Saturday
        $('#tfBoxSat').attr('readonly', true);
        $('#tfBoxSat').attr('required', false);
        $('#tfBoxSat1').attr('readonly', true);
        $('#tfBoxSat1').attr('required', false);
        $('#checkSat').on('change', function() {
            const element = document.getElementById('tfBoxSat');
            if (element.readOnly) {
                $('#tfBoxSat').attr('readonly', false);
                $('#tfBoxSat').attr('required', true);
                $('#tfBoxSat1').attr('readonly', false);
                $('#tfBoxSat1').attr('required', true);
            } else {
                $('#tfBoxSat').attr('readonly', true);
                $('#tfBoxSat').attr('required', false);
                $('#tfBoxSat1').attr('readonly', true);
                $('#tfBoxSat1').attr('required', false);

                //make clear
                $('#tfBoxSat').val('');
                $('#tfBoxSat1').val('');
            }
        });
        //Sunday
        $('#tfBoxSun').attr('readonly', true);
        $('#tfBoxSun').attr('required', false);
        $('#tfBoxSun1').attr('readonly', true);
        $('#tfBoxSun1').attr('required', false);
        $('#checkSun').on('change', function() {
            const element = document.getElementById('tfBoxSun');
            if (element.readOnly) {
                $('#tfBoxSun').attr('readonly', false);
                $('#tfBoxSun').attr('required', true);
                $('#tfBoxSun1').attr('readonly', false);
                $('#tfBoxSun1').attr('required', true);
            } else {
                $('#tfBoxSun').attr('readonly', true);
                $('#tfBoxSun').attr('required', false);
                $('#tfBoxSun1').attr('readonly', true);
                $('#tfBoxSun1').attr('required', false);

                //make clear
                $('#tfBoxSun').val('');
                $('#tfBoxSun1').val('');
            }
        });
    });
</script>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4">Doctor List</h4>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    You can view and manage doctors' information.
                    <button id="btnShowModalDialog" class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#addDoctorModal">New Doctor</button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Phone</th>
                                <th>Education</th>
                                <th>Speciality</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selectdoctor = "SELECT * from doctor d, speciality s where d.specialityId=s.specialityId";
                            $runselectdoctor = $connection->query($selectdoctor);
                            $countofdoctor = $runselectdoctor->num_rows;
                            if ($countofdoctor > 0) {
                                $dataofdoctor = $runselectdoctor->fetch_all(MYSQLI_BOTH);
                                $no = 0;
                                foreach ($dataofdoctor as $dataone) {
                                    $no++;
                                    $doctorId = $dataone['doctorId'];

                                    //Find whether schedule has been inserted or not
                                    $selectschedule="SELECT count(*) as SCount from schedule where doctorId=$doctorId";
                                    $runselectschedule=$connection->query($selectschedule);
                                    $dataofschedule=$runselectschedule->fetch_array(MYSQLI_ASSOC);
                                    

                                    echo "<tr>";
                                    echo "<td>$no</td>";
                                    echo "<td>" . $dataone['doctorName'] . "</td>";
                                    echo "<td><u>" . $dataone['doctorEmail'] . "</u></td>";
                                    echo "<td>&bull;&bull;&bull;&bull;&bull;&bull;</td>";
                                    echo "<td>" . $dataone['doctorPhone'] . "</td>";
                                    echo "<td>" . $dataone['education'] . "</td>";
                                    echo "<td>" . $dataone['speciality'] . "</td>";
                                    echo "<td class='col-2'>";
                                    echo "<a href='doctorlist.php?doctorIdToDelete=$doctorId' class='actionlink'><i class='fas fa-trash'></i>&nbsp;&nbsp;Delete</a>
                                            <br>
                                            <button id='addSchedule' data-bs-toggle='modal' data-bs-target='#scheduleModal' style='display:none;'>Schedule</button>
                                        ";
                                    if ($dataofschedule['SCount']>0) {
                                        echo "<a href='deleteSchedule.php?doctorIdToDeleteSchedule=$doctorId' class='actionlink text-danger'><i class='fas fa-trash'></i>&nbsp;&nbsp;Delete Schedule</a>";    
                                    }else{
                                        echo "<a href='doctorlist.php?doctorIdToSchedule=$doctorId' class='actionlink'><i class='fas fa-calendar-alt'></i>&nbsp;&nbsp;Add Schedule</a>";
                                    }
                                    
                                    echo "</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Phone</th>
                                <th>Education</th>
                                <th>Speciality</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>


    <!-- Modal dialog form -->
    <form method="post">
        <div class="modal fade" id="addDoctorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Doctor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfName" placeholder="Name" autocomplete="off" required />
                            <label for="inputName">Name</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputEmail" type="email" name="tfEmail" placeholder="Email" autocomplete="off" required />
                            <label for="inputEmail">Email address</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPassword" type="password" name="tfPass" placeholder="Password" required />
                            <label for="inputPassword">Password</label>
                            <span class="form-text">Password must be greater than 8 characters</span>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPassword" type="password" name="tfCPass" placeholder="Confirm Password" required />
                            <label for="inputPassword">Confirm Password</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputPhone" type="number" name="tfPhone" placeholder="Phone" autocomplete="off" required />
                            <label for="inputPhone">Phone</label>
                        </div>
                        <div class="form-floating mb-2">
                            <textarea class="form-control" placeholder="Address" id="inputAddress" name="tfEducation" style="height: 90px"></textarea>
                            <label for="inputAddress">Education</label>
                        </div>
                        <div class="form-floating mb-2">
                            <textarea class="form-control" placeholder="Address" id="inputAddress" name="tfIntroduction" style="height: 130px"></textarea>
                            <label for="inputAddress">Introduction</label>
                        </div>
                        <div class="form-group col-5 mb-2">
                            <label class="form-text">Select speciality</label>
                            <select class="form-select" name="tfSpeciality" aria-label="Default select example" required>
                                <option value="">None</option>
                                <?php
                                $selectspec = "SELECT * from speciality";
                                $runselectspec = $connection->query($selectspec);
                                $dataofspec = $runselectspec->fetch_all(MYSQLI_ASSOC);
                                foreach ($dataofspec as $data) {
                                    echo "<option value='" . $data['specialityId'] . "'>" . $data['speciality'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Clear</button>
                        <button type="submit" name="btnCreateDoctor" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- -------------- -->

    <!-- Schedule Modal -->
    <form method="post">
        <div class="modal fade" id="scheduleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Schedule</h5><br>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <label for="inputName">Selected Doctor</label>
                            <input class="form-control" id="inputName" type="text" placeholder="Name" value="<?php echo $doctorname; ?>" autocomplete="off" required readonly />
                        </div>
                        <div class="mb-4 px-3">
                            <div class="row mb-3">
                                <div class="col-2 form-check">
                                    <input class="form-check-input" type="checkbox" name="chkMon" id="checkMon" value="mon">
                                    <label class="form-check-label" for="checkMon">Monday</label>
                                </div>
                                <div class="col-5">
                                    <span class="form-text">From</span>
                                    <input type="time" name="tfMonFrom" id="tfBoxMon" class="form-control">
                                </div>
                                <div class="col-5">
                                    <span class="form-text">To</span>
                                    <input type="time" name="tfMonTo" id="tfBoxMon1" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2 form-check">
                                    <input class="form-check-input" type="checkbox" name="chkTue" id="checkTue" value="tue">
                                    <label class="form-check-label" for="checkTue">Tuesday</label>
                                </div>
                                <div class="col-5">
                                    <span class="form-text">From</span>
                                    <input type="time" name="tfTueFrom" id="tfBoxTue" class="form-control">
                                </div>
                                <div class="col-5">
                                    <span class="form-text">To</span>
                                    <input type="time" name="tfTueTo" id="tfBoxTue1" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2 form-check">
                                    <input class="form-check-input" type="checkbox" name="chkWed" id="checkWed" value="wed">
                                    <label class="form-check-label" for="checkWed">Wednesday</label>
                                </div>
                                <div class="col-5">
                                    <span class="form-text">From</span>
                                    <input type="time" name="tfWedFrom" id="tfBoxWed" class="form-control">
                                </div>
                                <div class="col-5">
                                    <span class="form-text">To</span>
                                    <input type="time" name="tfWedTo" id="tfBoxWed1" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2 form-check">
                                    <input class="form-check-input" type="checkbox" name="chkThur" id="checkThur" value="thur">
                                    <label class="form-check-label" for="checkThur">Thursday</label>
                                </div>
                                <div class="col-5">
                                    <span class="form-text">From</span>
                                    <input type="time" name="tfThurFrom" id="tfBoxThur" class="form-control">
                                </div>
                                <div class="col-5">
                                    <span class="form-text">To</span>
                                    <input type="time" name="tfThurTo" id="tfBoxThur1" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2 form-check">
                                    <input class="form-check-input" type="checkbox" name="chkFri" id="checkFri" value="fri">
                                    <label class="form-check-label" for="checkFri">Friday</label>
                                </div>
                                <div class="col-5">
                                    <span class="form-text">From</span>
                                    <input type="time" name="tfFriFrom" id="tfBoxFri" class="form-control">
                                </div>
                                <div class="col-5">
                                    <span class="form-text">To</span>
                                    <input type="time" name="tfFriTo" id="tfBoxFri1" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2 form-check">
                                    <input class="form-check-input" type="checkbox" name="chkSat" id="checkSat" value="sat">
                                    <label class="form-check-label" for="checkSat">Saturday</label>
                                </div>
                                <div class="col-5">
                                    <span class="form-text">From</span>
                                    <input type="time" name="tfSatFrom" id="tfBoxSat" class="form-control">
                                </div>
                                <div class="col-5">
                                    <span class="form-text">To</span>
                                    <input type="time" name="tfSatTo" id="tfBoxSat1" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2 form-check">
                                    <input class="form-check-input" type="checkbox" name="chkSun" id="checkSun" value="sun">
                                    <label class="form-check-label" for="checkSun">Sunday</label>
                                </div>
                                <div class="col-5">
                                    <span class="form-text">From</span>
                                    <input type="time" name="tfSunFrom" id="tfBoxSun" class="form-control">
                                </div>
                                <div class="col-5">
                                    <span class="form-text">To</span>
                                    <input type="time" name="tfSunTo" id="tfBoxSun1" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Clear</button>
                        <button type="submit" name="btnCreateSchedule" class="btn btn-primary">Create</button>
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