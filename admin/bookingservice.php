<?php
include('header.php');
include('../connect.php');
if (isset($_GET['bsIdToDelete'])) {
    echo "<script>
			var x=confirm('Are you sure to delete this booking service?');
			if(x==true){
				location='deletebookingservice.php?bsIdToDelete=" . $_GET['bsIdToDelete'] . "';
			}else{
				location='bookingservice.php';
			}
		</script>";
}
if (isset($_GET['bsIdToConfirm'])) {
    $acceptquery = "UPDATE bookingservice set status=TRUE where bsId=" . $_GET['bsIdToConfirm'];
    $runacceptquery = $connection->query($acceptquery);
    if ($runacceptquery) {
        echo "<script>location='bookingservice.php'</script>";
    } else {
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
            <h4 class="mt-4">Service Booking List</h4>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    You can view and manage booking service list.
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Booking Code</th>
                                <th>User</th>
                                <th>Service</th>
                                <th>Date/Time</th>
                                <th>Patient Count</th>
                                <th>Cost</th>
                                <th>Result</th>
                                <th>Status</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $select = "SELECT bs.*,s.*,u.* from bookingservice bs,service s,user u where
                                        bs.serviceId=s.serviceId and bs.userId=u.userId";
                            $runselect = $connection->query($select);
                            $countofbs = $runselect->num_rows;
                            if ($countofbs > 0) {
                                $dataofbs = $runselect->fetch_all(MYSQLI_BOTH);
                                $no = 0;
                                foreach ($dataofbs as $dataone) {
                                    $no++;
                                    $bookingserviceId = $dataone['bsId'];
                                    echo "<tr>";
                                    echo "<td>$no</td>";
                                    echo "<td>" . $dataone['bookingCode'] . "</td>";
                                    echo "<td><u>" . $dataone['userName'] . "</u></td>";
                                    echo "<td><u>" . $dataone['serviceName'] . "</u></td>";
                                    echo "<td>" . $dataone['operationDate']."<br>". $dataone['operationTime'] . "</td>";
                                    echo "<td>" . $dataone['noofPatient'] . "</td>";
                                    echo "<td>" . $dataone['estimatedCost'] . "</td>";
                                    if ($dataone['investigationResult']=="") {
                                        echo "<td><a href='addresultfile.php?bsIdToFile=$bookingserviceId' class='btn btn-primary'>Add</a></td>";
                                    }else{
                                        echo "<td>".basename($dataone['investigationResult'])."</td>";
                                    }
                                    if ($dataone['status'] == 1) {
                                        echo "<td>Confirmed</td>";
                                    } else {
                                        echo "<td style='color:green;'>Requested</td>";
                                    }
                                    echo "<td>";
                                        echo "
                                        <a href='bookingservice.php?bsIdToConfirm=$bookingserviceId' class='actionlink'>Confirm</a>
                                        <br>
                                        <a href='bookingservice.php?bsIdToDelete=$bookingserviceId' class='actionlink'>Delete</a>                                        
                                        ";
                                    echo "</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Booking Code</th>
                                <th>User</th>
                                <th>Service</th>
                                <th>Date/Time</th>
                                <th>Patient Count</th>
                                <th>Cost</th>
                                <th>Result</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!-- -------------- -->
</div>
<?php
include('footer.php');
?>