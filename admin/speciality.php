<?php
include('header.php');
include('../connect.php');
if (isset($_POST['btnCreateSpeciality'])) {
    $insert = "INSERT into speciality(speciality,description) values
            ('" . $_POST['tfSpeciality'] . "','" . $_POST['tfDescription'] . "')";
    $runinsert = $connection->query($insert);
    if ($runinsert) {
    } else {
        echo "<script>alert('Failed in insert query')</script>";
    }
}
if (isset($_GET['specIdToDelete'])) {
    echo "<script>
    	var x=confirm('Are you sure to delete this speciality?');
    	if(x==true){
    		location='deletespeciality.php?specIdToDelete=".$_GET['specIdToDelete']."';
    	}else{
    		location='speciality.php';
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

    .maketwoline {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4">Hospital Speciality Department List</h4>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    You can view and manage speciality's information.
                    <button id="btnShowModalDialog" class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#specialityModal">New Speciality</button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Speciality</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selectspeciality = "SELECT * from speciality";
                            $runselectspeciality = $connection->query($selectspeciality);
                            $countofspeciality = $runselectspeciality->num_rows;
                            if ($countofspeciality > 0) {
                                $dataofspeciality = $runselectspeciality->fetch_all(MYSQLI_BOTH);
                                $no = 0;
                                foreach ($dataofspeciality as $dataone) {
                                    $no++;
                                    $specId=$dataone['specialityId'];
                                    $speciality = $dataone['speciality'];
                                    $desp = $dataone['description'];
                                    echo "<tr>";
                                    echo "<td>$no</td>";
                                    echo "<td>$speciality</td>";
                                    echo "<td class='col-5 col-md-6'><p class='maketwoline'>$desp</p></td>";
                                    echo "<td>";
                                    echo "<a href='speciality.php?specIdToDelete=$specId' class='actionlink'><i class='fas fa-trash'></i>&nbsp;&nbspDelete</a>";
                                    echo "</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Speciality</th>
                                <th>Description</th>
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
        <div class="modal fade" id="specialityModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Speciality</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfSpeciality" placeholder="Speciality" autocomplete="off" required />
                            <label for="inputName">Speciality</label>
                        </div>
                        <div class="form-floating mb-2">
                            <textarea class="form-control" placeholder="Description" id="inputAddress" name="tfDescription" style="height: 130px"></textarea>
                            <label for="inputAddress">Description</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Clear</button>
                        <button type="submit" name="btnCreateSpeciality" class="btn btn-primary">Create</button>
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