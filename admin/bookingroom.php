<?php
include('header.php');
include('../connect.php');
if (isset($_GET['brIdToDelete'])) {
    echo "<script>
			var x=confirm('Are you sure to delete this booking room?');
			if(x==true){
				location='deletebookingroom.php?brIdToDelete=" . $_GET['brIdToDelete'] . "';
			}else{
				location='bookingroom.php';
			}
		</script>";
}
if (isset($_REQUEST['brIdToAssign'])) {
    $brId = $_REQUEST['brIdToAssign'];
    $bookingcodedata = $connection->query("SELECT * from bookingroom where brId=$brId")->fetch_array();
    $bookingcode = $bookingcodedata['bookingCode'];

    // $wardIdToAssign = $_REQUEST['wardIdToAssign'];
    // $rtIdToAssign = $_REQUEST['rtIdToAssign'];
    // $one = $_REQUEST['wardIdToAssign'];
    // $two = $_REQUEST['rtIdToAssign'];
    echo "
        <script>
            $(document).ready(function(){
                let btn=document.querySelector('#btnShowAssignDialog');
                btn.click();
            });
        </script>
    ";


    if (isset($_POST['btnAssign'])) {
        $roomIdToAssign = $_POST['tfRoomId'];

        $updateRoomBooking = "UPDATE bookingroom set roomId=$roomIdToAssign where brId=$brId";
        $runupdateRoomBooking = $connection->query($updateRoomBooking);
        if ($runupdateRoomBooking) {
            $updateRoom = "UPDATE room set bookedStatus=1 where roomId=$roomIdToAssign";
            $runupdateRoom = $connection->query($updateRoom);
            if ($runupdateRoom) {
                echo "<script>location='bookingroom.php'</script>";
            } else {
                echo "<script>alert('update failed')</script>";
            }
        } else {
            echo "<script>alert('update failed')</script>";
        }
    }
}
if (isset($_REQUEST['brIdToUnAssign'])) {
    $brId = $_REQUEST['brIdToUnAssign'];

    $roomIdToUnAssign = $_REQUEST['roomIdToUnAssign'];


    $updateRoomBooking = "UPDATE bookingroom set roomId=NULL where brId=$brId";
    $runupdateRoomBooking = $connection->query($updateRoomBooking);
    if ($runupdateRoomBooking) {
        $updateRoom = "UPDATE room set bookedStatus=0 where roomId=$roomIdToUnAssign";
        $runupdateRoom = $connection->query($updateRoom);
        if ($runupdateRoom) {
        } else {
            echo "<script>alert('update failed')</script>";
        }
    } else {
        echo "<script>alert('update failed')</script>";
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
    function goReload() {
        location = 'bookingroom.php';
    }
</script>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4">Room Booking List</h4>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    You can view and manage booking room list.
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Booking Code</th>
                                <th>User Name</th>
                                <th>Date</th>
                                <th>Needed Spec:</th>
                                <th>Room Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $select = "SELECT br.*,u.* from bookingroom br,user u where br.userId=u.userId";
                            $runselect = $connection->query($select);
                            $bookingroomlist = $runselect->fetch_all(MYSQLI_ASSOC);
                            $count = 0;
                            foreach ($bookingroomlist as $bookingroom) {
                                $count++;
                                $brId = $bookingroom['brId'];
                                $bookingcode = $bookingroom['bookingCode'];
                                $username = $bookingroom['userName'];
                                $date = $bookingroom['useDate'];
                                $spec = $bookingroom['reqInfo'];
                                $spec_array = explode(',', $spec);

                                $wardIdToAssign = $spec_array[0];
                                $rtIdToAssign = $spec_array[1];

                                //get ward
                                $selectward = "SELECT wardName from ward where wardId=$spec_array[0]";
                                $warddata = $connection->query($selectward)->fetch_array(MYSQLI_ASSOC);
                                $wardname = $warddata['wardName'];

                                //get room type
                                $selectroomtype = "SELECT rtName from roomtype where rtId=$spec_array[1]";
                                $rtdata = $connection->query($selectroomtype)->fetch_array(MYSQLI_ASSOC);
                                $rtname = $rtdata['rtName'];



                                echo "
                                    <tr>
                                        <td>$count</td>
                                        <td><u>$bookingcode</u></td>
                                        <td>$username</td>
                                        <td>$date</td>
                                        <td>Ward -> $wardname <br> Room Type -> $rtname</td>";
                                if ($bookingroom['roomId'] == "") {
                                    echo "<td><a href='bookingroom.php?brIdToAssign=$brId&&wardIdToAssign=$spec_array[0]&&rtIdToAssign=$spec_array[1]' class='btn btn-primary'><i class='far fa-calendar-plus'></i> Assign</a>
                                    <a href='' id='btnShowAssignDialog' class='btn btn-primary' style='display:none;' data-bs-toggle='modal' data-bs-target='#assignDialog'><i class='far fa-calendar-plus'></i> Show Assign Dialog</a></td>";
                                } else {
                                    $roomId = $bookingroom['roomId'];
                                    $selectroomno = "SELECT roomNumber from room where roomId=$roomId";
                                    $dataroomno = $connection->query($selectroomno)->fetch_array(MYSQLI_ASSOC);
                                    $roomnumber = $dataroomno['roomNumber'];

                                    echo "<td><span style='color:blue;'>$roomnumber</span> had been assigned to this booking<br>
                                    <a href='bookingroom.php?brIdToUnAssign=$brId&&roomIdToUnAssign=$roomId' class='btn btn-primary'><i class='far fa-calendar-plus'></i> Unassign</a></td>";
                                }
                                echo "<td><a href='bookingroom.php?brIdToDelete=$brId' class='actionlink'><i class='fas fa-trash'></i>&nbsp;&nbspDelete</a></td>";
                                echo "
                                    </tr>
                                    ";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Booking Code</th>
                                <th>User Name</th>
                                <th>Date</th>
                                <th>Needed Spec:</th>
                                <th>Room Number</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!-- -------------- -->
    <!-- Modal dialog form -->
    <form method="post">
        <div class="modal fade" id="assignDialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Assign Room To <?php echo $bookingcode; ?> </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="goReload()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group col-12 mb-2">
                            <label class="form-text">Select room type</label>
                            <select class="form-select" name="tfRoomId" aria-label="Default select example" required>
                                <option value="">None</option>
                                
                                <?php
                                if (isset($_REQUEST['brIdToAssign'])) {

                                    $wardIdToAssign = $_REQUEST['wardIdToAssign'];
                                    $rtIdToAssign = $_REQUEST['rtIdToAssign'];

                                    $selectrt = "SELECT * from room where wardId=$wardIdToAssign and rtId=$rtIdToAssign";
                                    $runselectrt = $connection->query($selectrt);
                                    $dataofrt = $runselectrt->fetch_all(MYSQLI_ASSOC);
                                    foreach ($dataofrt as $data) {
                                        if ($data['bookedStatus'] == 0) {
                                            echo "<option value='" . $data['roomId'] . "'>" . $data['roomNumber'] . "</option>";
                                        } else {
                                            echo "<option value='" . $data['roomId'] . "' disabled>" . $data['roomNumber'] . "</option>";
                                        }
                                    }
                                }

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Clear</button>
                        <button type="submit" name="btnAssign" class="btn btn-primary">Assign</button>
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