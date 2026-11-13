 <!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'public/includes/header.inc.php' ?>
</head>
<body class="tt-magic-cursor">

   <?php require 'public/includes/navbar.inc.php' ?>
    <!-- main Header end -->

    <!-- Hero Section Start --> 
<div class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 order-lg-1 order-2">
                <!-- Hero Left Content Start -->
                <div class="hero-content">
                    <div class="section-title wow fadeInUp">
                        <h3 class="wow fadeInUp" data-wow-delay="0.05s">Fair & Transparent Escrow</h3>
                        <h2 class="wow fadeInUp" data-wow-delay="0.25s">Peer-to-Peer Wagers. Settle Disputes with Confidence.</h2>
                    </div>

                    <div class="hero-body">
                        <p class="wow fadeInUp" data-wow-delay="0.75s">Create custom public or private games, stake your terms, and challenge friends or players worldwide with guaranteed payouts and verifiable proof.</p>
                    </div>

                    <div class="hero-footer">
                        <a href="#" class="btn-default wow fadeInUp" data-wow-delay="1.0s">Create a Game</a>
                        <a href="#" class="btn-default btn-accent wow fadeInUp" data-wow-delay="1.25s">Browse Public Bets</a>
                    </div>
                </div>
                <!-- Hero Left Content End -->
            </div>

            <div class="col-lg-6 col-md-12 order-lg-2 text-center order-1">
                <!-- Hero Image Start -->
                <div class="hero-img wow fadeInUp" data-wow-delay="0.50s">
                    <img src="/public/assets/uploads/home-hero-img.png" alt="Peer-to-Peer Game Challenge">
                </div>
                <!-- Hero Image End -->
            </div>
        </div>
    </div>
</div>
<!-- Hero Section End --> 

    <!-- Jackpot Section Start -->
    <div class="jackpot-section wow fadeInUp" data-wow-delay="0.05s">
        <div class="container">
            <div class="row align-items-center">
                <!-- Jackpot Image start -->
                <div class="col-lg-2 col-md-2 text-md-left text-center order-md-1 order-3">
                    <div class="jackpot-img wow fadeInUp" data-wow-delay="0.25s">
                        <img src="/public/assets/uploads/progressive-jackpot-img.png" alt="">
                    </div>
                </div>
                <!-- Jackpot Image end -->

                <!-- Jackpot Heading start -->
                <div class="col-lg-4 col-md-5 text-md-left text-center order-2">
                    <div class="jackpot-title wow fadeInUp" data-wow-delay="0.50s">
                        <h2>Progressive <span>Winnings</span></h2>
                    </div>
                </div>
                <!-- Jackpot Heading end -->

                <!-- Jackpot Counter start -->
                <div class="col-lg-6 col-md-5 order-md-3 order-1">
                    <div class="jackpot-counter wow fadeInUp" data-wow-delay="0.75s">
                        <span class="counter" id="counter-number" data-start="16526908" data-end="99999999.99" data-decimals="2" data-duration="299999999"></span>
                    </div>
                </div>
                <!-- Jackpot Counter end -->
            </div>
        </div>
    </div>
    <!-- Jackpot Section End -->
    <!-- About Section Start -->
    <?php require 'public/sections/about-home.section.php' ?> 
    <!-- About Section End -->

   <!-- How to Play Section Start -->
    <?php require 'public/sections/top-games.section.php' ?> 
    <!-- How to Play Section End --> 

    <!-- Trusted Casino Section Start -->
    <?php //require 'public/sections/categories.section.php' ?>
    <!-- Trusted Casino Section End -->


    <!-- Recent Posts Section Start -->
    <?php //require 'public/sections/recent-posts.section.php' ?>
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

    <!-- FAQs Section Start -->
   <?php require 'public/sections/faq.section.php' ?>
    <!-- FAQs Section Ends -->

   <?php require 'public/includes/footer.inc.php' ?>
</body>
</html>