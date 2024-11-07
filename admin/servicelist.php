<?php
include('header.php');
include('../connect.php');
if (isset($_GET['serviceIdToDelete'])) {
    echo "<script>
        var x=confirm('Are you sure to delete this service?');
        if(x==true){
            location='deleteservice.php?serviceIdToDelete=".$_GET['serviceIdToDelete']."';
        }else{
            location='servicelist.php';
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
            <h4 class="mt-4">Service List</h4>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    You can view and manage service.
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Service Title</th>
                                <th>Section 1</th>
                                <th>Section 2</th>
                                <th>Section 3</th>
                                <th>Book Permission</th>
                                <th>Service Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $select = "SELECT s.*,st.* from service s,servicetype st where s.stId=st.stId";
                            $runselect=$connection->query($select);
                            $countofservice=$runselect->num_rows;
                            if ($countofservice > 0) {
                                $dataofservice=$runselect->fetch_all(MYSQLI_ASSOC);
                                $no = 0;
                                foreach ($dataofservice as $dataone) {
                                    $no++;
                                    $serviceId = $dataone['serviceId'];
                                    echo "<tr>";
                                    echo "<td>$no</td>";
                                    echo "<td><img src='".$dataone['serviceImg']."' style='width:50px; height:auto;''></td>";
                                    echo "<td><u>" . $dataone['serviceName'] . "</u></td>";
                                    echo "<td>" . $dataone['sec1'] . "</td>";
                                    echo "<td>" . $dataone['sec2'] . "</td>";
                                    echo "<td>" . $dataone['sec3'] . "</td>";
                                    if ($dataone['bookable']==0) {
                                        echo "<td></td>";
                                    }else{
                                        echo "<td>Allowed</td>";
                                    }
                                    echo "<td>" . $dataone['stServicetype'] . "</td>";
                                    echo "<td>
                                    			<a href='servicelist.php?serviceIdToDelete=$serviceId' class='actionlink btn btn-danger'>Delete</a>
                                    		</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Service Title</th>
                                <th>Section 1</th>
                                <th>Section 2</th>
                                <th>Section 3</th>
                                <th>Book Permission</th>
                                <th>Service Type</th>
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