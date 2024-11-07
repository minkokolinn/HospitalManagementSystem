<?php
include('header.php');
include('connect.php');
?>
<style>
    #medCard {
        box-sizing: border-box;
        padding-top: 20px;
        transition: 1s;
        border-radius: 20px;
        text-align: center;
    }

    #medCard:hover {
        box-sizing: border-box;
        transition: 1s;
        box-shadow: 0 0 5px 1px #999;
        transform: scale(1.01);
    }

    /* skin 2 */
    .skin-2 .num-in {
        background: #FFFFFF;
        box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.15);
        border-radius: 25px;
        height: 40px;
        width: 110px;
        float: left;
    }

    .skin-2 .num-in span {
        width: 40%;
        display: block;
        height: 40px;
        float: left;
        position: relative;
    }

    .skin-2 .num-in span:before,
    .skin-2 .num-in span:after {
        content: '';
        position: absolute;
        background-color: #667780;
        height: 2px;
        width: 10px;
        top: 50%;
        left: 50%;
        margin-top: -1px;
        margin-left: -5px;
    }

    .skin-2 .num-in span.plus:after {
        transform: rotate(90deg);
    }

    .skin-2 .num-in input {
        float: left;
        width: 20%;
        height: 40px;
        border: none;
        text-align: center;
    }

    /* / skin 2 */
</style>
<script>
    $(document).ready(function() {
        $('#inputSearch').on('keyup', function() {
            var searchText = $(this).val().toLowerCase();
            $('#med_content>div').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
            });
        });
    });

    function myFunc() {
        $('#exampleModalLong').modal('show');
    }

    function doReaload() {
        location = 'medicine.php';
    }
    /////////////////// product +/-
    $(document).ready(function() {
        $('.num-in span').click(function() {
            var $input = $(this).parents('.num-block').find('input.in-num');
            if ($(this).hasClass('minus')) {
                var count = parseFloat($input.val()) - 1;
                count = count < 1 ? 1 : count;
                if (count < 2) {
                    $(this).addClass('dis');
                } else {
                    $(this).removeClass('dis');
                }
                $input.val(count);
            } else {
                var count = parseFloat($input.val()) + 1
                $input.val(count);
                if (count > 1) {
                    $(this).parents('.num-block').find(('.minus')).removeClass('dis');
                }
            }

            $input.change();
            return false;
        });

    });
    // product +/-
</script>
<?php
if (isset($_REQUEST['midToDetail'])) {
    $midToDetail = $_REQUEST['midToDetail'];
    $selectmed = "SELECT * from medicine where medicineId=$midToDetail";
    $runselectmed = $connection->query($selectmed);
    if ($runselectmed->num_rows == 1) {
        $dataofmed = $runselectmed->fetch_array(MYSQLI_ASSOC);
        $medName = $dataofmed['medicineName'];
        $medImg = $dataofmed['medicineImg'];
        $medSize = $dataofmed['size'];
        $medMadein = $dataofmed['madein'];
        $medIngredient = $dataofmed['ingredient'];
        $medPrice = $dataofmed['price'];
        $medQuantity = $dataofmed['quantity'];
        $medDescription = $dataofmed['description'];
        echo "<script>$(document).ready(function(){myFunc();});</script>";
    }

    if (isset($_POST['btnAddToCart'])) {
        if (isset($_REQUEST['midToDetail'])) {
            if ($medQuantity > 0) {
                $neededProductAmount = $_POST['tfItemCount'];
                if ($neededProductAmount > $medQuantity) {
                    echo "<script>alert('Not enough item! Only $medQuantity items will be available!')</script>";
                } else {
                    if (isset($_SESSION['uid'])) {
                        $midToDetail=$_REQUEST['midToDetail'];
                        echo "<script>alert('Added $neededProductAmount items of $medName to your cart...')</script>";
                        echo "<script>location='addtocart.php?addToCart=on&&midToCart=$midToDetail&&quantity=$neededProductAmount'</script>";
                    } else {
                        echo "<script>alert('Login first to order medicine! Your cart is unavailable if you have not logined into our system!')</script>";
                        echo "<script>location='login.php'</script>";
                    }
                }
            } else {
                echo "<script>alert('Your selected item is out of stock! It is unavailable to buy')</script>";
            }
        } else {
            echo "<script>alert('u didn't even click detail')</script>";
        }
    }
}


?>
<div id="site-start-section">
    <section class="page-title bg-1">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center">
                        <h1 class="text-capitalize mb-5 text-lg">Available medicine</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="fetaure-page " style="margin-top: 80px; margin-bottom: 80px;">
        <div class="container">
            <div class="d-flex justify-content-end mb-5">
                <form class="form-inline col-12">
                    <div class="form-group mx-sm-3 mb-2" style="flex-grow: 1;">
                        <label for="inputPassword2" class="sr-only">Search something</label>
                        <input type="text" class="form-control" id="inputSearch" id="inputPassword2" style="flex-grow: 1;" placeholder="Search something">
                        <!-- <div class="input-group-prepend"> -->
                        <!-- </div> -->
                    </div>
                </form>
            </div>
            <div class="row" id="med_content">
                <?php
                $select = "SELECT * from medicine";
                $runselect = $connection->query($select);
                $dataofmedicine = $runselect->fetch_all(MYSQLI_ASSOC);
                foreach ($dataofmedicine as $data) {
                    $mid = $data['medicineId'];
                    $image = $data['medicineImg'];
                    $name = $data['medicineName'];
                    $price = $data['price'];
                    $madein = $data['madein'];
                    $quantity = $data['quantity'];
                    if ($quantity > 0) {
                        $stock = "<span style='text-decoration:underline;'>In Stock</span>";
                    } else {
                        $stock = "<span class='text-danger'>Out Of Stock</span>";
                    }
                    echo "
                    <div class='col-lg-3 col-md-6 mb-3' id='medCard'>
                        <a href='medicine.php?midToDetail=$mid'>
                            <div class='about-block-item mb-5 mb-lg-0'>
                                <img src='admin/$image' alt='' class='img-fluid w-100'>
                                <h4 class='mt-3'>$name</h4>
                                <p>
                                    Price - $price MMK 
                                    <br>
                                    Made in $madein
                                    <br>
                                    $stock
                                </p>
                            </div>
                        </a>
                    </div>
                    ";
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Medicine Information Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="doReaload()">
                            <span aria-hidden="true" class="text-white">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-5 mb-sm-5">
                                <img src="<?php echo "admin/$medImg" ?>" alt="" class="col-lg-12 col-md-6 col-sm-8">
                            </div>
                            <div class="col-lg-7">
                                <table class="table table-borderless">
                                    <tr>
                                        <td>Name</td>
                                        <td>-</td>
                                        <td><b><?php echo $medName ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Size</td>
                                        <td>-</td>
                                        <td><b><?php echo $medSize ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Made In</td>
                                        <td>-</td>
                                        <td><b><?php echo $medMadein ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Ingredient</td>
                                        <td>-</td>
                                        <td><b><?php echo $medIngredient ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Stock</td>
                                        <td>-</td>
                                        <td><b>
                                                <?php
                                                if ($medQuantity > 0) {
                                                    echo "In Stock";
                                                } else {
                                                    echo "<span class='text-danger'>Out Of Stock</span>";
                                                }
                                                ?>
                                            </b></td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td>-</td>
                                        <td><b style="font-size: 24px;"><?php echo $medPrice ?> MMK</b></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row mx-5">
                            <?php
                            if ($medDescription != "") {
                                echo "
                            <table class='table table-borderless'>
                            <tr style='font-size:16px;'>
                                <td>Description</td>
                                <td>-</td>
                                <td style='text-align: justify;'>$medDescription</td>
                            </tr>
                            </table>    
                            ";
                            }
                            ?>
                        </div>
                        <div class="row">
                            <div class="col-md-9 col-sm-6 d-flex align-items-center justify-content-end text-dark">
                                <b>Number of products (add to cart) </b>
                            </div>
                            <div class="col-2">
                                <div class="num-block skin-2">
                                    <div class="num-in">
                                        <span class="minus"></span>
                                        <input type="text" class="in-num" name="tfItemCount" value="1" readonly="">
                                        <span class="plus"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="btnAddToCart">
                            <div class="d-flex align-items-center"><i class="icofont-shopping-cart mr-2" style="font-size: 24px;"></i> ADD TO CARD</div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>