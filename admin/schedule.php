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
    function goReload() {
        location = 'wardadd.php';
    }
</script>
<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4">Schedule</h4>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    You can view schedule's information.
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Doctor</th>
                                <th>Schedule</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $selectdoctor="SELECT * from doctor";
                                $runselectdoctor=$connection->query($selectdoctor);
                                $dataofdoctor=$runselectdoctor->fetch_all(MYSQLI_ASSOC);
                                $count=0;
                                foreach ($dataofdoctor as $eachdoctor) {
                                    $count++;
                                    $doctorId=$eachdoctor['doctorId'];
                                    $doctorName=$eachdoctor['doctorName'];

                                    echo "<tr>";
                                    echo "<td>$count</td>";
                                    echo "<td>$doctorName</td>";
                                    echo "<td>";
                                    $selectschedule="SELECT * from schedule where doctorId=$doctorId";
                                    $runselectschedule=$connection->query($selectschedule);
                                    $dataofschedule=$runselectschedule->fetch_all(MYSQLI_ASSOC);
                                    foreach ($dataofschedule as $eachschedule) {
                                        echo "<span class='text-primary'>".$eachschedule['dayOfSchedule']."</span> -> &nbsp;&nbsp;&nbsp; From <u>".$eachschedule['startTime']."</u> To <u>".$eachschedule['endTime']."</u><br>";

                                    }
                                    echo "</td>";
                                    echo "</td>";
                                }

                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Doctor</th>
                                <th>Schedule</th>
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