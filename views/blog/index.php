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
                        <h1 class="wow fadeInUp" data-wow-delay="0.25s">Blog</h1>
                        <ul class="breadcrumb wow fadeInUp" data-wow-delay="0.50s">
                            <li><a href="/">Home</a></li>
                            <li>Blog</li>
                        </ul>
                    </div>
                    <!-- Sub page Header end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Subpage Hero Section End -->
 
    <!-- Blog Archive Start -->
    <div class="blog-post-lists">
        <div class="container">
            <div class="row">
              
            <?php foreach($this->blog['data'] as $blog) { ?>
                <!-- Post item Start -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="post-item box-border-linear-gradient wow fadeInUp" data-wow-delay="0.75s">
                        <div class="post-img">
                            <a href="/blog/<?= $blog['blog_slug'] ?>"><img src="/public/assets/uploads/<?= $blog['blog_image'] ?>" alt="<?= $blog['blog_title'] ?>"></a>
                        </div>

                        <div class="post-content">
                            <div class="post-header">
                                <div class="post-meta">
                                    <ul>
                                        <li><i class="fa-solid fa-calendar-days"></i> <?= date('d M Y', strtotime($blog['blog_created_at'])) ?></li>
                                    </ul>
                                </div>

                                <h2><a href="/blog/<?= $blog['blog_slug'] ?>"><?= $blog['blog_title'] ?></a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Post item End -->
                 <?php } ?>
  
            </div>
        </div>


          <!-- Pagination Footer -->
           
           <?php $currentPage  = max(1, (int) ($_GET['pg'] ?? 1)); 
           $totalPerPage = max(1, (int) ($this->_settings['user_loop_sequence'] ?? 24)); 
           $from = (($currentPage*$totalPerPage)-$totalPerPage); ?>
            <div class="card-footer bg-transparent border-secondary px-4 py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                <span class="text-white small">Showing <strong><?= $from===0?1:$from ?>–<?= count($this->blog['data']) ?></strong> of <strong><?= $this->blog['count'] ?></strong> ledger entries</span>
                <nav aria-label="Transaction history pagination">
                    <ul class="pagination pagination-sm mb-0">
                       

                         <?php
        
        
        $totalCount   = max(0, (int) ($this->blog['count'] ?? 0));

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
            <!--------------------------------->
    </div>
    <!-- Blog Archive End -->
 

    <!-- Contact Us Page End -->

    <?php require 'public/includes/footer.inc.php' ?>
</body>
</html>