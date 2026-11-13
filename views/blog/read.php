<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'public/includes/header.inc.php' ?>
</head>
<body class="tt-magic-cursor">

    <!-- Preloader Start -->
     <?php require 'public/includes/navbar.inc.php' ?>
    <!-- main Header end -->

    <!-- Subpage Hero Section Start -->
    <div class="subpage-header"  style="background-image: url('/public/assets/uploads/<?= $this->blog[0]['blog_image'] ?>');">
        <div class="container">
            <div class="row">
                <div class="co-md-12">
                    <!-- Sub page Header start -->
                    <div class="subpage-header-box">
                        <h1 class="wow fadeInUp" data-wow-delay="0.25s"><?= $this->blog[0]['blog_title'] ?></h1>
                        <ul class="breadcrumb wow fadeInUp" data-wow-delay="0.50s">
                            <li><a href="/">Home</a></li>
                            <li><?= $this->blog[0]['blog_title'] ?></li>
                        </ul>
                    </div>
                    <!-- Sub page Header end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Subpage Hero Section End -->

   <!-- Blog Single Page Section Start -->
    <div class="page-blog-single">
        <div class="container">
            <!-- Featured Image Start -->
            <div class="row">
                <div class="col-md-12">
                    <div class="post-feature-image wow fadeInUp" data-wow-delay="0.25s">
                        <img src="images/post-1.jpg" alt="">
                    </div>
                </div>
            </div>
            <!-- Featured Image End -->

            <!-- Post Content Start -->
            <div class="row single-post-content">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <!-- Social Sharing Button Start -->
                            <div class="post-soical-link sidebar box-border-linear-gradient wow fadeInUp"
                                data-wow-delay="0.50s">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-whatsapp"></i></a></li>
                                </ul>
                            </div>
                            <!-- Social Sharing Button End -->
                        </div>

                        <div class="col-md-10">
                             <?= $this->blog[0]['blog_content'] ?>

                            <!-- Post Tags Start -->
                            <div class="post-tag wow fadeInUp" data-wow-delay="1.0s">
                                <ul>
                                    <!-- <li class="box-border-linear-gradient"><a href="#">#gamers</a></li>
                                    <li class="box-border-linear-gradient"><a href="#">#casino</a></li>
                                    <li class="box-border-linear-gradient"><a href="#">#jackpot</a></li>
                                    <li class="box-border-linear-gradient"><a href="#">#Disc</a></li>
                                    <li class="box-border-linear-gradient"><a href="#">#bonuses</a></li> -->
                                </ul>
                            </div>
                            <!-- Post Tags End -->

                            <!-- Post Pagination Start -->
                            <!-- <div class="post-btn wow fadeInUp" data-wow-delay="1.25s">
                                <div class="btn-pre box-border-linear-gradient">
                                    <a href="blog-single.html" class="btn-default"><i class="fa-regular fa-circle-left"></i>Previous</a>
                                </div>
                                <div class="btn-next box-border-linear-gradient">
                                    <a href="blog-single.html" class="btn-default">Next<i class="fa-regular fa-circle-right"></i></a>
                                </div>
                            </div> -->
                            <!-- Post Pagination End -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Post Content End -->
        </div>
    </div>
    <!-- Blog Single Page Section End -->

    <!-- Recent Posts Section Start -->
    <div class="recent-post-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Section Title start -->
                    <div class="section-title text-center wow fadeInUp" data-wow-delay="0.50s">
                        <h3 class="wow fadeInUp" data-wow-delay="0.25s">News & Blog</h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.50s">Recent News</h2>
                    </div>
                    <!-- Section Title end -->
                </div>
            </div>

            <div class="row">
             <?php $blogData = $this->blog[1]; require 'public/sections/blog.section.php'; ?>

            </div>
        </div>
    </div>
    <!-- Recent Posts Section End -->
 

    <!-- Contact Us Page End -->

    <?php require 'public/includes/footer.inc.php' ?>
</body>
</html>