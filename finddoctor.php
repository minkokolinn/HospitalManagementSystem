<?php
include('header.php');
include('connect.php');
if (isset($_POST['btnSearch'])) {
    $specId = $_POST['cboSpec'];
    $doctorId = $_POST['cboDoc'];

    if ($specId == "" || $doctorId == "") {
        echo "<script>location='finddoctor.php'</script>";
    } else {
        $selectdoctor = "SELECT * from doctor where doctorId=$doctorId and specialityId=$specId";
        $runselectdoctor = $connection->query($selectdoctor);
        $dataofdoctor = $runselectdoctor->fetch_array(MYSQLI_ASSOC);
        $sel_doctorId = $dataofdoctor['doctorId'];
        $sel_doctorName = $dataofdoctor['doctorName'];
        $sel_grad = $dataofdoctor['education'];
        $sel_intro = $dataofdoctor['introduction'];
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
<style>
    .makeline {
        display: -webkit-box;
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
</style>
<div style="margin-top: 130px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <div class="section-title">
                    <h2>Find doctors</h2>
                    <div class="divider mx-auto my-4"></div>
                    <form class="form-inline" method="post">
                        <select class="form-control col-4 mr-4" id="SpecBox" name="cboSpec">
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
                        <select class="form-control col-4 mr-4" id="DocBox" name="cboDoc">
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
                        <button type="submit" class="col-2 p-2" name="btnSearch" style="color:white; border-width: 0px; background-color: #0069D9; border-radius: 20px;"><i class="icofont-search-2"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <?php
            if (isset($sel_doctorId)) {
                echo "
                <div class='col-sm-12 col-md-6 col-lg-4 mb-5'>
                    <div class='card shadow-sm'>
                        <div class='card-body'>
                            <h5 class='card-title'>$sel_doctorName</h5>
                            <span style='text-decoration: underline;'>$sel_grad</span>
                            <p class='card-text makeline'>$sel_intro</p>
                            <a href='doctordetail.php?doctorIdToDetail=$sel_doctorId' class='btn btn-primary'>Read More</a>
                        </div>
                    </div>
                </div>
                ";
            } else {
                $selectdoctor = "SELECT * from doctor";
                $runselectdoctor = $connection->query($selectdoctor);
                $dataofdoctor = $runselectdoctor->fetch_all(MYSQLI_ASSOC);
                foreach ($dataofdoctor as $eachdata) {
                    $doctorId = $eachdata['doctorId'];
                    $doctorName = $eachdata['doctorName'];
                    $grad = $eachdata['education'];
                    $intro = $eachdata['introduction'];
                    echo "
                <div class='col-sm-12 col-md-6 col-lg-4 mb-5'>
                    <div class='card shadow-sm'>
                        <div class='card-body'>
                            <h5 class='card-title'>$doctorName</h5>
                            <span style='text-decoration: underline;'>$grad</span>
                            <p class='card-text makeline'>$intro</p>
                            <a href='doctordetail.php?doctorIdToDetail=$doctorId' class='btn btn-primary'>Read More</a>
                        </div>
                    </div>
                </div>
                ";
                }
            }
            ?>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>