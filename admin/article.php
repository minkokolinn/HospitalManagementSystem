<?php
include('header.php');
include('../connect.php');
if (isset($_SESSION['logintype']) && $_SESSION['logintype'] == "doctor") {
    $doctorid = $_SESSION['loginid'];
} else {
    echo "<script>alert('Invalid Permission!')</script>";
    echo "<script>location='home.php'</script>";
}
if (isset($_POST['btnCreateArticle'])) {
    $insert = "INSERT into article(title,subtitle,category,article,uploadDate,doctorId) values
            ('" . $_POST['tfTitle'] . "','" . $_POST['tfSTitle'] . "','" . $_POST['tfCategory'] . "',
            '" . $_POST['tfArticle'] . "','" . $_POST['tfDate'] . "',$doctorid)";
    $runinsert = $connection->query($insert);
    if ($runinsert) {
        echo "<script>alert('Sucessfully created an article')</script>";
    } else {
        echo "<script>alert('Failed in insert query')</script>";
    }
}
if (isset($_GET['articleIdToDelete'])) {
    echo "<script>
    	var x=confirm('Are you sure to delete this article?');
    	if(x==true){
    		location='deletearticle.php?articleIdToDelete=" . $_GET['articleIdToDelete'] . "';
    	}else{
    		location='article.php';
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
            <h4 class="mt-4">Article List</h4>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    You can view and manage article's information. These are only articles you uploaded.
                    <button id="btnShowModalDialog" class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#articleModal">New Article</button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Doctor</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selectarticle = "SELECT a.*,d.* from article a,doctor d where a.doctorId=d.doctorId";
                            $runselectarticle = $connection->query($selectarticle);
                            $countofarticle = $runselectarticle->num_rows;
                            if ($countofarticle > 0) {
                                $dataofarticle = $runselectarticle->fetch_all(MYSQLI_BOTH);
                                $no = 0;
                                foreach ($dataofarticle as $dataone) {
                                    $no++;
                                    $articleId = $dataone['articleId'];
                                    $title = $dataone['title'];
                                    $subtitle = $dataone['subtitle'];
                                    $category = $dataone['category'];
                                    $uploadate = $dataone['uploadDate'];
                                    $doctorIdEach = $dataone['doctorId'];
                                    $doctorName=$dataone['doctorName'];
                                    echo "<tr>";
                                    echo "<td>$no</td>";
                                    echo "<td><p class='maketwoline'>$title</p></td>";
                                    echo "<td><p class='maketwoline'>$subtitle</p></td>";
                                    echo "<td><p class='maketwoline'>$category</p></td>";
                                    echo "<td><p class='maketwoline'>$uploadate</p></td>";
                                    echo "<td><p class='maketwoline'>$doctorName</p></td>";
                                    echo "<td>";
                                    if ($doctorid == $doctorIdEach) {
                                        echo "<a href='article.php?articleIdToDelete=$articleId' class='actionlink'><i class='fas fa-trash'></i>&nbsp;&nbspDelete</a>";
                                    }
                                    echo "</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Doctor</th>
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
        <div class="modal fade" id="articleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfTitle" placeholder="Title" autocomplete="off" required />
                            <label for="inputName">Title</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfSTitle" placeholder="Sub Title" autocomplete="off" required />
                            <label for="inputName">Sub Title</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfCategory" placeholder="Category" autocomplete="off" required />
                            <label for="inputName">Category</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input class="form-control" id="inputName" type="text" name="tfDate" placeholder="Upload Date" value="<?php echo date("Y/m/d"); ?>" autocomplete="off" required readonly />
                            <label for="inputName">Upload Date</label>
                        </div>
                        <div class="form-floating mb-2">
                            <textarea class="form-control" placeholder="Article" id="inputAddress" name="tfArticle" style="height: 200px" required></textarea>
                            <label for="inputAddress">Article</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Clear</button>
                        <button type="submit" name="btnCreateArticle" class="btn btn-primary">Create</button>
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