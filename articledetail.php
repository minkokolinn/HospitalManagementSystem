<?php
include('header.php');
include('connect.php');
if (isset($_REQUEST['articleIdToDetail'])) {
    $articleIdToDetail = $_REQUEST['articleIdToDetail'];
    $selectarticle = "SELECT * from article a,doctor d where a.doctorId=d.doctorId and a.articleId=$articleIdToDetail";
    $runselectarticle = $connection->query($selectarticle);
    $dataofarticle = $runselectarticle->fetch_array(MYSQLI_ASSOC);
} else {
    echo "<script>alert('Invalid action')</script>";
    echo "<script>location='article.php'</script>";
}
?>
<div id="site-start-section">
    <section class="section blog-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12 mb-5">
                            <div class="single-blog-item">
                                <div class="blog-item-content mt-5">
                                    <div class="blog-item-meta mb-3">
                                        <span class="text-black text-capitalize mr-3"><i class="icofont-calendar mr-2"></i> <?php echo $dataofarticle['uploadDate']; ?></span>
                                        <span class="text-color-2 text-capitalize mr-3"><i class="icofont-book-mark mr-2"></i> <?php echo $dataofarticle['category']; ?></span>
                                        <span class="text-muted text-capitalize mr-3"><i class='icofont-pencil-alt-1 mr-2'></i><?php echo $dataofarticle['doctorName']; ?></span>
                                    </div>
                                    <h2 class="mb-4 text-md"><a href="blog-single.html"><?php echo $dataofarticle['title']; ?></a></h2>
                                    <p class="lead mb-4"><?php echo $dataofarticle['subtitle']; ?></p>
                                    <p><?php echo $dataofarticle['article']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include('footer.php');
?>