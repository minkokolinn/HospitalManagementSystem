<?php
include('header.php');
include('../connect.php');
if (isset($_POST['btnCreateWard'])) {
    $insert = "INSERT into ward(wardName) values('" . $_POST['tfWard'] . "')";
    $runinsert = $connection->query($insert);
    if ($runinsert) {
    } else {
        echo "<script>alert('Insert query failed')</script>";
    }
}
if (isset($_GET['wardIdToDelete'])) {
    echo "<script>
			var x=confirm('Are you sure to delete this hosptial ward info?');
			if(x==true){
				location='deleteward.php?wardIdToDelete=" . $_GET['wardIdToDelete'] . "';
			}else{
				location='wardadd.php';
			}
		</script>";
}
if (isset($_GET['wardIdToAddRoom'])) {
    $wardIdToAddRoom = $_GET['wardIdToAddRoom'];
    $selectward = "SELECT * from ward where wardId=$wardIdToAddRoom";
    $runselectward = $connection->query($selectward);
    $dataward = $runselectward->fetch_array(MYSQLI_ASSOC);
    $wardNameSelected = $dataward['wardName'];
    echo "<script>
    $(document).ready(function(){
        let btnAddRoom=document.querySelector('#addMoreRoom');
        btnAddRoom.click();
    });
    </script>";
}
if (isset($_POST['btnAddRoom'])) {
    $wardIdToAddRoom = $_GET['wardIdToAddRoom'];
    if ($wardIdToAddRoom != "") {
        $roomNumber = "R" . $_POST['tfRoomNumber'];
        $rtId = $_POST['tfRtId'];
        $roomNote = $_POST['tfRoomNote'];

        $selectsameroomno = "SELECT roomNumber from room where roomNumber='$roomNumber'";
        $runselectsameroomno = $connection->query($selectsameroomno);
        if ($runselectsameroomno->num_rows > 0) {
            echo "<script>alert('This Room has been already inserted!')</script>";
        } else {
            $insert = "INSERT into room(roomNumber,roomNote,bookedStatus,wardId,rtId)
                values('$roomNumber','$roomNote',FALSE,'$wardIdToAddRoom','$rtId')";
            $runinsert = $connection->query($insert);
            if ($runinsert) {
                echo "<script>alert('added successfully!')</script>";
                echo "<script>location='wardadd.php'</script>";
            } else {
                echo "<script>alert('insert query failed!')</script>";
            }
        }
    } else {
        echo "<script>alert('ward id is not found!')</script>";
    }
}

?>
<script>
    $(document).ready(function() {
        $("#DocBox>option").filter(function() {
            $(this).hide();
        });

        var selected = 0;
        $("#SpecBox").on("change", function() {
            var valSpec = $(this).val();
            $("#DocBox>option").filter(function() {
                if (valSpec == $(this).attr("id")) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            if (selected == 1) {
                $("#DocBox").val("");
            }
        });

        $("#DocBox").on("change", function() {
            selected = 1;
        });
    });
</script>
<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4">Appointment</h4>

            <form method="post">
                <div class="row my-3">
                    <div class="col-3">
                        <select class="form-select" id="SpecBox" name="cboSpec" required>
                            <option value="">Choose Speciality</option>
                            <?php
                            $runselectspec = $connection->query("SELECT * from speciality");
                            $dataofspec = $runselectspec->fetch_all(MYSQLI_ASSOC);
                            foreach ($dataofspec as $eachspec) {
                                $specId = $eachspec['specialityId'];
                                $spec = $eachspec['speciality'];
                                echo "<option value='$specId'>$spec</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <select class="form-select" id="DocBox" name="cboDoc" required>
                            <option value="" id="">Choose Doctor</option>
                            <?php
                            $runselectdoctor = $connection->query("SELECT * from doctor");
                            $dataofdoctor = $runselectdoctor->fetch_all(MYSQLI_ASSOC);
                            foreach ($dataofdoctor as $eachdoctor) {
                                $doctorId = $eachdoctor['doctorId'];
                                $doctor = $eachdoctor['doctorName'];
                                $specId = $eachdoctor['specialityId'];
                                echo "<option value='$doctorId' id='$specId'>$doctor</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <input type="date" class="form-control" name="tfDate" required>
                    </div>
                    <div class="col-3">
                        <button type="submit" name="btnSearch" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    You can view and manage appointment's information.
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Doctor</th>
                                <th>Patient</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['btnSearch'])) {
                                $doctorId = $_POST['cboDoc'];
                                $apptDate = $_POST['tfDate'];
                                $selectappt = "SELECT * from appointment a,doctor d,user u where a.doctorId=d.doctorId and a.userId=u.userId and a.doctorId=$doctorId and a.appt_date='$apptDate'";
                                $runselectappt = $connection->query($selectappt);
                                $dataofappt = $runselectappt->fetch_all(MYSQLI_ASSOC);
                                if ($runselectappt->num_rows > 0) {
                                    
                                    $count=0;
                                    foreach ($dataofappt as $eachappt) {
                                        $count++;
                                        $apptId=$eachappt['appointmentId'];
                                        echo "<tr>";
                                        echo "<td>".$count."</td>";
                                        echo "<td>".$eachappt['appt_date']."</td>";
                                        echo "<td>".$eachappt['doctorName']."</td>";
                                        echo "<td>".$eachappt['userName']."</td>";
                                        echo "<td>".$eachappt['appt_stime']."</td>";
                                        echo "<td>".$eachappt['appt_etime']."</td>";
                                        echo "<td><a href='deleteappt.php?apptIdToDelete=$apptId' class='actionlink'><i class='fas fa-trash'></i>&nbsp;&nbspDelete</a></td>";
                                        echo "</tr>";
                                    }
                                    
                                } else {
                                    echo "<tr class='text-center'>
                                    <td colspan='7'>No Appointment Found!</td>
                                </tr>";
                                }
                                
                            } else {
                                echo "<tr class='text-center'>
                                    <td colspan='7'>Please fill search form to get results</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Doctor</th>
                                <th>Patient</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>


    <!-- Add Room Dialog -->
    <form method="post">
        <div class="modal fade" id="addRoomModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Room To <?php echo $wardNameSelected; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="goReload()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <div class="input-group">
                                <div class="input-group-text">R</div>
                                <input class="form-control" id="inputRoomNumber" type="number" name="tfRoomNumber" placeholder="Room Number" autocomplete="off" required />
                            </div>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfWard" value="<?php echo $wardNameSelected; ?>" autocomplete="off" readonly />
                            <label for="inputName">Ward Name</label>
                        </div>
                        <div class="form-group col-5 mb-2">
                            <label class="form-text">Select room type</label>
                            <select class="form-select" name="tfRtId" aria-label="Default select example" required>
                                <option value="">None</option>
                                <?php
                                $selectrt = "SELECT * from roomtype";
                                $runselectrt = $connection->query($selectrt);
                                $dataofrt = $runselectrt->fetch_all(MYSQLI_ASSOC);
                                foreach ($dataofrt as $data) {
                                    echo "<option value='" . $data['rtId'] . "'>" . $data['rtName'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-floating mb-2">
                            <textarea class="form-control" placeholder="Room Note" id="inputAddress" name="tfRoomNote" style="height: 250px" autocomplete="off"></textarea>
                            <label for="inputAddress">Room Note</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="btnAddRoom" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- --------------- -->
</div>
<?php
include('footer.php');
?>