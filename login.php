<?php
include('header.php');
include('connect.php');
if (isset($_SESSION['uid'])) {
    echo "<script>location='index.php'</script>";
}

if (isset($_POST['btnUserLogin'])) {
    $userEmail=$_POST['tfUserEmail'];
    $userPassword=$_POST['tfUserPassword'];
    $selectuser="SELECT * from user where userEmail='$userEmail'";
    $runselectuser=$connection->query($selectuser);
    if ($runselectuser->num_rows==1) {
        $dataofuser=$runselectuser->fetch_array(MYSQLI_BOTH);
        if (password_verify($userPassword,$dataofuser['userPassword'])) {
            $_SESSION['uid']=$dataofuser['userId'];
            echo "<script>alert('Login successfully')</script>";
            echo "<script>location='index.php'</script>";
        }else{
            echo "<script>alert('Password Wrong! Login failed!')</script>";    
        }
    }else {
        echo "<script>alert('Invalid Email! Login failed!')</script>";
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
                        <div class="col-lg-3">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <input name="tfUserEmail" id="name" type="email" class="form-control" placeholder="Your Email Address (e.g example@gmail.com)" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                            <input name="tfUserPassword" id="email" type="password" class="form-control" placeholder="Your Password" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <input class="btn btn-main btn-round-full mx-2" name="btnUserLogin" type="submit" value="Sign In"></input>
                        <a href="index.php" class="btn btn-main btn-round-full mx-2">Back To Home</a>
                        <label class="form-text mt-3" style="text-decoration: underline;"><a href="register.php">I don't have an account! Sign up an new account</a></label>
                    </div>
                </form>
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