<?php
include('header.php');
include('connect.php');
if (isset($_SESSION['uid'])) {
    $userId=$_SESSION['uid'];
}else{
    echo "<script>alert('Please Login First!')</script>";
    echo "<script>location='login.php'</script>";
}

if (isset($_POST['btnCreateTestimonial'])) {
    $insert="INSERT into testimonial(userId,testimonial,uploadDate) values
            ($userId,'".$_POST['tfTestimonial']."','".$_POST['tfDate']."')";
    $runinsert=$connection->query($insert);
    if ($runinsert) {
        echo "<script>location='testimonial.php'</script>";
    }else{
        echo "<script>alert('Insert query failed!')</script>";
    }
}

?>
<section class="section testimonial-2 gray-bg" style="margin-top: 80px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="section-title text-center">
                    <h2>Latest Testimonial</h2>
                    <div class="divider mx-auto my-4"></div>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addTestimonial">New Testimonial</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 testimonial-wrap-2">
                <?php
                $selecttestimonial="SELECT t.*,u.* from testimonial t,user u where t.userId=u.userId order by uploadDate desc";
                $runselecttestimonial=$connection->query($selecttestimonial);
                $count=$runselecttestimonial->num_rows;
                if ($count>0) {
                    $dataoftestimonial=$runselecttestimonial->fetch_all(MYSQLI_ASSOC);
                    foreach ($dataoftestimonial as $dataone) {
                        $date=$dataone['uploadDate'];
                        $testimonial=$dataone['testimonial'];
                        $userName=$dataone['userName'];
                        echo "
                        <div class='testimonial-block style-2  gray-bg'>
                        <i class='icofont-quote-right'></i>
    
                        <div class='client-info '>
                            <h4>$userName</h4>
                            <p>$date</p>
                            <p>
                                $testimonial                                
                            </p>
                        </div>
                    </div>
                        ";
                    }
                }
                ?>
            </div>
        </div>
        
    </div>
</section>
<section class="section testimonial-2 gray-bg">
    <div class="container">
        <div class="row align-items-center">
            <?php
                $selecttestimonial="SELECT t.*,u.* from testimonial t,user u where t.userId=u.userId";
                $runselecttestimonial=$connection->query($selecttestimonial);
                $count=$runselecttestimonial->num_rows;
                if ($count>0) {
                    $dataoftestimonial=$runselecttestimonial->fetch_all(MYSQLI_ASSOC);
                    foreach ($dataoftestimonial as $dataone) {
                        $date=$dataone['uploadDate'];
                        $testimonial=$dataone['testimonial'];
                        $userName=$dataone['userName'];
                        echo "
                        <div class='col-lg-4 '>
                <div class='testimonial-block style-2  gray-bg'>
                    <i class='icofont-quote-right'></i>

                    <div class='client-info '>
                        <h4>$userName</h4>
                        <p>$date</p>
                        <p>
                            $testimonial                         
                        </p>
                    </div>
                </div>
            </div>
                        ";
                    }
                }
                ?>
        </div>
    </div>
</section>

<!--Version 4 Modal -->
<form method="post">
    <div class="modal fade" id="addTestimonial" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Give Testimonial</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="label-email">Date:</label>
                        <input type="text" name="tfDate" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="label-email" aria-describedby="emailHelp" autocomplete="off" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Testimonial</label>
                        <textarea class="form-control" name="tfTestimonial" id="exampleFormControlTextarea1" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="btnCreateTestimonial" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
include('footer.php');
?>