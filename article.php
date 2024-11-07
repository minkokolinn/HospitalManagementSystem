<?php
include('header.php');
include('connect.php');
?>
<style>
  .makeline {
    display: -webkit-box;
    overflow: hidden;
    text-overflow: ellipsis;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }
</style>
<div id="site-start-section">
    <section class="page-title bg-1">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center">
                        <h1 class="text-capitalize mb-5 text-lg">Health Articles</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-2">

            </div>
            <div class="col-lg-8">
                <?php
                $selectArticle="SELECT * from article a,doctor d where a.doctorId=d.doctorId order by a.uploadDate desc";
                $runselectArticle=$connection->query($selectArticle);
                $dataofArticle=$runselectArticle->fetch_all(MYSQLI_ASSOC);
                foreach ($dataofArticle as $eachdata) {
                    $articleId=$eachdata['articleId'];
                    $title=$eachdata['title'];
                    $subtitle=$eachdata['subtitle'];
                    $category=$eachdata['category'];
                    $uploadDate=$eachdata['uploadDate'];
                    $doctorName=$eachdata['doctorName'];
                    echo "
                    <div class='row'>
                        <div class='col-lg-12 col-md-12 mb-5'>
                            <div class='blog-item'>
                                <div class='blog-item-content'>
                                    <div class='blog-item-meta mb-3 mt-4'>
                                        <span class='text-black text-capitalize mr-3'><i class='icofont-calendar mr-1'></i> $uploadDate</span>
                                        <span class='text-black text-capitalize mr-3'><i class='icofont-flag'></i> $category</span>
                                        <span class='text-black text-capitalize mr-3'><i class='icofont-pencil-alt-1'></i> $doctorName</span>
                                    </div>
                                    <h3 class='mt-3 mb-3'><a href='blog-single.html'>$title</a></h3>
                                    <p class='mb-4 makeline'>$subtitle</p>
                                    <a href='articledetail.php?articleIdToDetail=$articleId' target='_blank' class='btn btn-main btn-icon btn-round-full'>Read More <i class='icofont-simple-right ml-2  '></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
                }

                ?>
            </div>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>