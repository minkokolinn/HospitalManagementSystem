<?php
include('header.php');
if (isset($_SESSION['uid'])) {
    echo "<script>location='index.php'</script>";
}

if (isset($_POST['btnCreateUser'])) {
    if ($_POST['tfUserPass']==$_POST['tfUserCPass']) {
        $hashedpass=password_hash($_POST['tfUserPass'],PASSWORD_DEFAULT);
        $insertquery="INSERT into user(userName,userEmail,userPassword,userPhone,userAddress,userDob,userBloodType,userNrc,userNote) values
                    ('".$_POST['tfUserName']."','".$_POST['tfUserEmail']."','$hashedpass',
                    '".$_POST['tfUserPhone']."','".$_POST['tfUserAddress']."','".$_POST['tfUserDob']."',
                    '".$_POST['tfUserBt']."','".$_POST['tfUserNrc']."','".$_POST['tfUserNote']."')";
        $runinsert=$connection->query($insertquery);
        if ($runinsert) {
            echo "<script>alert('Successfully created an user account')</script>";
            echo "<script>window.location='login.php'</script>";
        }else{
            if($connection->errno==1062){
                echo "<script>alert('An account with this email already existed. Login failed and try again with another email')</script>";
            }else{
                echo "<script>alert('Insert query failed!')</script>";  
            }
        }
    }else{
        echo "<script>alert('Password and Confirm Password must be the same...')</script>"; 
    }
}
?>
<script>
    document.getElementById("site-header").style.display = "none";
</script>

<!-- Login form -->
<section class="contact-form-wrap section" style="padding: 50px 0px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    <h2 class="text-md mb-2">Sign in your account</h2>
                    <div class="divider mx-auto my-4"></div>
                    <p class="mb-5">For some transactions like booking, appointment and ordering statement, you need to sign up your information and sign in again.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <form id="contact-form" method="post">
                    <!-- form message -->
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input name="tfUserName" id="name" type="text" class="form-control" placeholder="Your Name" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input name="tfUserEmail" id="name" type="email" class="form-control" placeholder="Your Email Address (e.g example@gmail.com)" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input name="tfUserPass" id="email" type="password" class="form-control" placeholder="Create a new password" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input name="tfUserCPass" id="email" type="password" class="form-control" placeholder="Confirm Password" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input name="tfUserPhone" id="email" type="number" class="form-control" placeholder="Your Phone Number" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input name="tfUserAddress" id="email" type="text" class="form-control" placeholder="Address" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="dob" class="form-text">Date of birth :</label>
                                <input name="tfUserDob" id="dob" type="date" class="form-control" placeholder="Date of birth" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="bt" class="form-text">Blood type : </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tfUserBt" id="inlineRadio1" value="A" checked />
                                    <label class="form-check-label" for="inlineRadio1">A</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tfUserBt" id="inlineRadio2" value="B" />
                                    <label class="form-check-label" for="inlineRadio2">B</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tfUserBt" id="inlineRadio3" value="AB" />
                                    <label class="form-check-label" for="inlineRadio3">AB</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tfUserBt" id="inlineRadio4" value="O" />
                                    <label class="form-check-label" for="inlineRadio4">O</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <input name="tfUserNrc" id="nrc" type="text" class="form-control" placeholder="NRC or Passport" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <textarea name="tfUserNote" id="" class="form-control" style="height: 200px;" placeholder="Note (any medical notice should be added.)"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div class="col-lg-2"></div>
                        <input type="submit" class="btn btn-main btn-round-full col-2" name="btnCreateUser" value="Sign Up"/>
                        <div class="col-lg-2"></div>
                    </div>
                </form>
                <div class="d-flex justify-content-center">
                    <label class="form-text mt-3" style="text-decoration: underline;"><a href="login.php">Already have an account!</a></label>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include('footer.php');
?>
<script>
    document.getElementById("myUpanelFooter").style.display = "none";
</script>