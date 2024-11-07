<?php
include('header.php');
include('../connect.php');
if (isset($_GET['roomIdToDelete'])) {
    echo "<script>
			var x=confirm('Are you sure to delete this room info?');
			if(x==true){
				location='deleteroom.php?roomIdToDelete=" . $_GET['roomIdToDelete'] . "';
			}else{
				location='roomlist.php';
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


    .makeline {
        display: -webkit-box;
        width: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }

</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4">Available Room List</h4>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    You can view and manage rooms' information.
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Ward Name</th>
                                <th>Room Number</th>
                                <th>Room Type</th>
                                <th>Booking Status</th>
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selectroom = "SELECT r.*,w.*,rt.* from room r,ward w,roomtype rt where r.wardId=w.wardId and r.rtId=rt.rtId order by r.wardId,r.roomNumber";
                            $runselectroom = mysqli_query($connection, $selectroom);
                            $countofroom = mysqli_num_rows($runselectroom);
                            if ($countofroom > 0) {
                                $dataofroom = mysqli_fetch_all($runselectroom, MYSQLI_ASSOC);
                                $no = 0;
                                foreach ($dataofroom as $dataone) {
                                    $no++;
                                    $roomId = $dataone['roomId'];
                                    echo "<tr>";
                                    echo "<td>$no</td>";
                                    echo "<td>" . $dataone['wardName'] . "</td>";
                                    echo "<td><u>" . $dataone['roomNumber'] . "</u></td>";
                                    echo "<td>" . $dataone['rtName'] . "</td>";
                                    if ($dataone['bookedStatus'] == 0) {
                                        echo "<td>Free</td>";
                                    } else {
                                        echo "<td>Booked</td>";
                                    }
                                    echo "<td><p class='makeline'>" . $dataone['roomNote'] . "...</p></td>";
                                    echo "<td>
                                    			<a href='roomlist.php?roomIdToDelete=$roomId' class='actionlink'><i class='fas fa-trash'></i>&nbsp;&nbspDelete</a>
                                    		</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Ward Name</th>
                                <th>Room Number</th>
                                <th>Room Type</th>
                                <th>Booking Status</th>
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>

</div>
<?php
include('footer.php');
?>