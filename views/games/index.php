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
    <div class="subpage-header">
        <div class="container">
            <div class="row">
                <div class="co-md-12">
                    <!-- Sub page Header start -->
                    <div class="subpage-header-box">
                        <h1 class="wow fadeInUp" data-wow-delay="0.25s">Join a Public Game</h1>
                        <ul class="breadcrumb wow fadeInUp" data-wow-delay="0.50s">
                            <li><a href="/">Home</a></li>
                            <li>Join a Public Game</li>
                        </ul>
                    </div>
                    <!-- Sub page Header end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Subpage Hero Section End -->

  
     <!-- Online Games & Slot Section Start -->
    <div class="gameslot-section">
        <div class="container">
            <div class="row">
                <!-- Sidebar Start -->
                <div class="col-lg-2 col-md-4 col-12">
                    <!-- <div class="gameslot-category-itme sidebar box-border-linear-gradient wow fadeInUp" data-wow-delay="0.25s">
                        <h3>Categories</h3>
                        <ul class="Category-item">
                            <li><img src="images/icon-live-casino.svg" alt=""><a href="#">Live Casino</a></li>
                            <li><img src="images/icon-slot.svg" alt=""><a href="#">Slots</a></li>
                            <li><img src="images/icon-blackjack.svg" alt=""><a href="#">Black Jack</a></li>
                            <li><img src="images/icon-roulette-color.svg" alt=""><a href="#">Roulette</a></li>
                            <li><img src="images/icon-video-poker-color.svg" alt=""><a href="#">Video Poker</a></li>
                            <li><img src="images/icon-table-games-color.svg" alt=""><a href="#">Table Games</a></li>
                        </ul>
                    </div> -->
                </div>
                <!-- Sidebar End -->

                <!-- Games Content Start -->
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="row"> 

                         
                    <?php foreach($this->games['data'] as $index => $row ) { ?>
                        <!-- Slot item start -->
                        <div class="col-lg-4 col-md-6">
                            <div class="slot-item box-border-linear-gradient wow fadeInUp" data-wow-delay="2.25s">
                                <div class="slot-header">
                                    <div class="slot-playnow">
                                        <a href="/games/<?= $row['game_url'] ?>" class="btn-default">Play Now</a>
                                    </div>

                                    <div class="slot-img">
                                        <img src="/public/assets/uploads/dummy.jpg" alt="<?= $row['title'] ?>">
                                    </div>
                                </div>

                                <div class="slot-body text-center">
                                    <h3><?= $row['title'] ?></h3>
                                    <p>Players (<?= $row['total_players']??'' ?>)</p>
                                </div>
                            </div>
                        </div>
                        <!-- Slot item end -->
                         <?php } ?>
                    </div>

                      <!-- Pagination Footer -->
           <?php $currentPage  = max(1, (int) ($_GET['pg'] ?? 1)); 
           $totalPerPage = max(1, (int) ($this->_settings['user_loop_sequence'] ?? 24)); 
           $from = (($currentPage*$totalPerPage)-$totalPerPage); ?>
            <div class="card-footer bg-transparent border-secondary px-4 py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                <span class="text-white small">Showing <strong><?= $from===0?1:$from ?>–<?= count($this->games['data']) ?></strong> of <strong><?= $this->games['count'] ?></strong> ledger entries</span>
                <nav aria-label="Transaction history pagination">
                    <ul class="pagination pagination-sm mb-0">
                       

                         <?php 
        $totalCount   = max(0, (int) ($this->games['count'] ?? 0));

        $totalPages = (int) ceil($totalCount / $totalPerPage); 

        // Nothing to paginate
        if ($totalPages > 1) { 
            $window = 2; 
            $pages = [];

            // Always show first page
            $pages[] = 1;

            // Pages around current page
            $start = max(2, $currentPage - $window);
            $end   = min($totalPages - 1, $currentPage + $window);

            // Ellipsis after first page
            if ($start > 2) {
                $pages[] = '...';
            }

            for ($i = $start; $i <= $end; $i++) {
                $pages[] = $i;
            }

            // Ellipsis before last page
            if ($end < $totalPages - 1) {
                $pages[] = '...';
            }

            // Always show last page
            if ($totalPages > 1) {
                $pages[] = $totalPages;
            }


            // Previous
            if ($currentPage > 1) {
                ?> 
                
                <li class="page-item  ">
                    <a class="page-link bg-dark border-secondary text-white" href="<?= CustomFunctions::formatDynamicUrl('pg', (string) ($currentPage - 1)) ?>" tabindex="-1">Previous</a>
                </li> 
                <?php
            }


            // Page numbers
            foreach ($pages as $page) {

                if ($page === '...') {
                    ?>
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                    <?php
                    continue;
                }

                ?> 
                <li class="page-item <?= ($currentPage == $page) ? 'active' : '' ?>">
                    <a class="page-link bg-dark border-secondary text-light" href="<?= CustomFunctions::formatDynamicUrl('pg', (string) $page) ?>"><?= $page ?></a></li>
                <?php
            }


            // Next
            if ($currentPage < $totalPages) {
                ?> 
                 <li class="page-item">
                    <a class="page-link bg-dark border-secondary text-light" href="<?= CustomFunctions::formatDynamicUrl('pg', (string) ($currentPage + 1)) ?>">Next</a>
                </li>
                <?php
            }

        }
        ?>

                    </ul>
                </nav>
            </div>
            <!-------------------------------->
                </div>
                <!-- Games Content End -->
            </div>
        </div>
    </div>
    <!-- Online Games & Slot Section End -->
     

    <?php require 'public/includes/footer.inc.php' ?>
</body>
</html>