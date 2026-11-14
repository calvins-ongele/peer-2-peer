<?php 
    $stats = $this->games;
    //echo "<pre>"; print_r($stats); echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head> 
    <?php require ADMIN . 'includes/header.inc.php' ?> 
     <style>
        .star {
          font-size: 2rem;
          color: lightgray;
          cursor: pointer;
        }
    
        .star.selected {
          color: gold;
        }
      </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <main class="wrapper">
         
        <?php require ADMIN . 'includes/sidebar.inc.php' ?>
         
            <div class="content-wrapper px-4 py-2">
            <div class="row" cxlass="content-header d-flex justify-content-between">  
                <div class="col-md-5"><a href='#'   class='btn btn-sm btn-primary  ' >Games Stats</a> </div>
                <div class="col-md-7 ">
               
                </div>
            </div>
            <div class="content px-2">
                
                    <div class='container alert'>
                        
                    

                    <!-- Admin Dashboard KPI Summary Cards Section Start -->
<section class="admin-summary-section py-4">
    <div class="container-fluid px-lg-4">
        
        <!-- Section Header -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <div>
                <h4 class="text-white fw-bold mb-1">
                    <i class="fa-solid fa-gauge-high text-warning me-2"></i>Platform Overview & Escrow Metrics
                </h4>
                <p class="text-muted small mb-0">Real-time operational metrics across active wagers, dispute queues, and platform revenue.</p>
            </div>
            <div class="d-flex gap-2">
                <select class="form-select form-select-sm bg-dark text-light border-secondary w-auto" onchange="fetchLimit(this)">
                    <option value="all">All Time</option>
                    <option value="<?= CustomFunctions::formatDynamicUrl('limiter', 'today') ?>" 
                            <?= ($_GET['limiter']??'')=='today'?'selected':'' ?>>Today</option>
                    <option value="<?= CustomFunctions::formatDynamicUrl('limiter', '7d') ?>" 
                            <?= ($_GET['limiter']??'')=='7d'?'selected':'' ?>>Last 7 Days</option>
                    <option value="<?= CustomFunctions::formatDynamicUrl('limiter', '30d') ?>" 
                            <?= ($_GET['limiter']??'')=='30d'?'selected':'' ?>>Last 30 Days</option>
                    <option value="<?= CustomFunctions::formatDynamicUrl('limiter', '180d') ?>" 
                            <?= ($_GET['limiter']??'')=='180d'?'selected':'' ?>>Last 6 Months</option>
                    <option value="<?= CustomFunctions::formatDynamicUrl('limiter', '365d') ?>" 
                            <?= ($_GET['limiter']??'')=='365d'?'selected':'' ?>>Last 1 Year</option> 
                </select>
                <a href="/dashboard/games/profits" class="btn btn-sm btn-warning fw-bold" type="button">
                    <i class="fa-solid fa-rotate me-1"></i> Refresh
                </a>
            </div>
        </div>

        <!-- Primary Financial & Escrow KPI Cards (Row 1) -->
        <div class="row g-4 mb-4">
            
            <!-- KPI 1: Total Locked Escrow -->
            <div class="col-xl-3 col-md-6">
                <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="text-muted small text-uppercase fw-bold d-block">Total Escrow Vault</span>
                                <h3 class="text-warning fw-bold mt-1 mb-0">$<?= $stats['totalEscrowVolt'][0]['totalEscrowVolt'] ?></h3>
                            </div>
                            <div class="bg-warning bg-opacity-25 text-warning rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fa-solid fa-vault fs-4"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between small pt-2 border-top border-secondary border-opacity-50">
                            <span class="text-success fw-medium"><i class="fa-solid fa-arrow-trend-up me-1"></i>+12.4%</span>
                            <span class="text-muted">Across <?= $stats['totalEscrowVolt'][0]['totalGames'] ?> active games</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KPI 2: Net Platform Revenue (5% Fees) -->
            <div class="col-xl-3 col-md-6">
                <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="text-muted small text-uppercase fw-bold d-block">Service Fee Revenue</span>
                                <h3 class="text-success fw-bold mt-1 mb-0">$<?= $stats['totalRevenue'][0]['totalRevenue'] ?></h3>
                            </div>
                            <div class="bg-success bg-opacity-25 text-success rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fa-solid fa-sack-dollar fs-4"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between small pt-2 border-top border-secondary border-opacity-50">
                            <span class="text-success fw-medium"><i class="fa-solid fa-arrow-trend-up me-1"></i>+8.1%</span>
                            <span class="text-muted"><?= PLATFORM_FEE_PC ?>% fee on settled pots</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KPI 3: Action Required - Pending Disputes -->
            <div class="col-xl-3 col-md-6">
                <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 shadow-sm h-100 border-danger">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="text-danger small text-uppercase fw-bold d-block">Disputes Awaiting Review</span>
                                <h3 class="text-white fw-bold mt-1 mb-0"><?= $stats['disputed'][0]['disputedGames'] ?> <span class="fs-6 text-danger fw-normal">Urgent</span></h3>
                            </div>
                            <div class="bg-danger bg-opacity-25 text-danger rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fa-solid fa-gavel fs-4"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between small pt-2 border-top border-secondary border-opacity-50">
                            <span class="text-warning fw-medium">$<?= $stats['disputed'][0]['disputedAmounts'] ?> disputed</span>
                            <a href="/dashboard/games/index?status=disputed" class="text-warning text-decoration-none fw-bold">Review Queue <i class="fa-solid fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KPI 4: Registered & Active Users -->
            <div class="col-xl-3 col-md-6">
                <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="text-muted small text-uppercase fw-bold d-block">Active Bettors</span>
                                <h3 class="text-info fw-bold mt-1 mb-0"><?= number_format($stats['totalUsers'][0]['totalUsers']) ?></h3>
                            </div>
                            <div class="bg-info bg-opacity-25 text-info rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fa-solid fa-users fs-4"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between small pt-2 border-top border-secondary border-opacity-50">
                            <span class="text-info fw-medium">+148 new this week</span>
                            <span class="text-white">100% verified</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Secondary Operational Breakdown Cards (Row 2) -->
        <div class="row g-4">
            
            <!-- Breakdown Card 1: Game Lifecycle Status Distribution -->
            <div class="col-lg-6">
                <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 shadow-sm h-100">
                    <div class="card-header bg-transparent border-secondary py-3 px-4 d-flex justify-content-between align-items-center">
                        <h6 class="text-white fw-bold mb-0"><i class="fa-solid fa-chart-pie text-warning me-2"></i>Games by Status</h6>
                        <span class="badge bg-secondary">Total: <?= number_format(count($stats['allGames'])) ?></span>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-sm-4 col-6 mb-2">
                                <div class="p-3 bg-secondary bg-opacity-15 rounded-3 border border-secondary">
                                    <?php 
                                        $completed = array_filter($stats['allGames'], fn($g)=>($g['status']==='completed') ); 
                                        $totalCompleted = (count($completed)===0)?1:count($completed);
                                    ?>
                                    <?php $settled = array_filter($stats['allGames'], fn($g)=>(( $g['status']==='completed') && ($g['status']==='completed') ) ); ?>
                                    <span class="badge bg-success mb-2">completed</span>
                                    <h5 class="text-white fw-bold mb-0"><?= number_format(count($completed)) ?></h5>
                                    <small class="text-white"><?= (count($settled) / $totalCompleted)*100 ?>% settled</small>
                                </div>
                            </div>
                            <div class="col-sm-4 col-6 mb-2">
                                <div class="p-3 bg-secondary bg-opacity-15 rounded-3 border border-secondary">
                                    <span class="badge bg-warning text-dark mb-2">in_progress</span>
                                    <?php $inProgress = array_filter($stats['allGames'], fn($g)=>($g['status']==='in_progress') ); ?>
                                    <h5 class="text-white fw-bold mb-0"><?= count($inProgress) ?></h5>
                                    <small class="text-white">100% active</small>
                                </div>
                            </div>
                            <div class="col-sm-4 col-6 mb-2">
                                <div class="p-3 bg-secondary bg-opacity-15 rounded-3 border border-secondary">
                                    <span class="badge bg-info text-dark mb-2">pending</span>
                                    <?php $pending = array_filter($stats['allGames'], fn($g)=>($g['status']==='pending') ); ?>
                                    <h5 class="text-white fw-bold mb-0"><?= count($pending) ?></h5>
                                    <small class="text-white">Awaiting invites</small>
                                </div>
                            </div>
                            <div class="col-sm-4 col-6 mb-2">
                                <div class="p-3 bg-secondary bg-opacity-15 rounded-3 border border-secondary">
                                    <span class="badge bg-danger mb-2">Admin Overriden</span>
                                    <?php $overriden = array_filter($stats['allGames'], fn($g)=>($g['status']==='overriden_by_admin') ); ?>
                                    <h5 class="text-white fw-bold mb-0"><?= count($overriden) ?></h5>
                                    <small class="text-white">100% escalated</small>
                                </div>
                            </div>
                            <div class="col-sm-4 col-6 mb-2">
                                <div class="p-3 bg-secondary bg-opacity-15 rounded-3 border border-secondary">
                                    <span class="badge bg-secondary mb-2">Cancelled b4 </span>
                                    <?php $cancelled = array_filter($stats['allGames'], fn($g)=>($g['status']==='cancelled_b4_start') ); ?>
                                    <h5 class="text-white fw-bold mb-0"><?= count($cancelled) ?></h5>
                                    <small class="text-white">100% refunded</small>
                                </div>
                            </div>
                            <div class="col-sm-4 col-6 mb-2">
                                <div class="p-3 bg-secondary bg-opacity-15 rounded-3 border border-secondary">
                                    <span class="badge bg-dark border border-secondary mb-2">Abandoned</span>
                                    <?php $abandoned = array_filter($stats['allGames'], fn($g)=>($g['status']==='abandoned_after_start') ); ?>
                                    <h5 class="text-white fw-bold mb-0"><?= count($abandoned) ?></h5>
                                    <small class="text-white">Forfeited / timed out</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Breakdown Card 2: Game Types & Feature Adoption -->
            <div class="col-lg-6">
                <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 shadow-sm h-100">
                    <div class="card-header bg-transparent border-secondary py-3 px-4 d-flex justify-content-between align-items-center">
                        <h6 class="text-white fw-bold mb-0"><i class="fa-solid fa-sliders text-warning me-2"></i> Match Modes & Rule Flags</h6>
                        <span class="text-muted small">Active Distribution</span>
                    </div>
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        
                        <!-- Public vs Private Progress Bar -->
                         <?php 
                                $public = array_filter($stats['allGames'], fn($g)=>($g['game_type']==='public') ); 
                                $totalGames = count($stats['allGames']);
                                $private = $totalGames  - count($public);
                                $privatePc = ( $private / ($totalGames===0?1:$totalGames) ) * 100;
                                $publicPc = ( count($public) / ($totalGames===0?1:$totalGames) ) * 100;
                            ?>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between small mb-1">
            <span class="text-light fw-medium" title="<?= $private ?>" ><i class="fa-solid fa-user-lock text-warning me-1"></i> Private 1-on-1 Games (<?= $privatePc ?>%)</span>
    
            <span class="text-light fw-medium" title="<?= count($public) ?>" ><i class="fa-solid fa-globe text-info me-1"></i> Public Link Games (<?= $publicPc ?>%)</span>
                            </div>
                            <div class="progress bg-secondary" style="height: 10px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $privatePc ?>%" aria-valuenow="<?= $privatePc ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-info" role="progressbar" style="width: <?= $publicPc ?>%" aria-valuenow="<?= $publicPc ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <!-- Feature Metric Pills -->
                        <div class="row g-3">
                            <div class="col-sm-4">
                                <div class="p-3 bg-secondary bg-opacity-15 rounded-3 border border-secondary text-center">
                                    <i class="fa-solid fa-shield-check text-success fs-5 mb-1"></i>
                                    <?php $provable = array_filter($stats['allGames'], fn($g)=>($g['can_be_publicly_proven']===1) );  ?>
                                    <h6 class="text-white fw-bold mb-0"><?= (count($provable)/($totalGames===0?1:$totalGames))*100 ?>%</h6>
                                    <span class="text-white small d-block">Publicly Provable</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="p-3 bg-secondary bg-opacity-15 rounded-3 border border-secondary text-center">
                                    <i class="fa-solid fa-arrows-rotate text-info fs-5 mb-1"></i>
                                    <?php $dobleOrNothing = array_filter($stats['allGames'], fn($g)=>($g['can_be_publicly_proven']===1) );  ?>
                                    <h6 class="text-white fw-bold mb-0"><?= (count($dobleOrNothing)/($totalGames===0?1:$totalGames))*100 ?>%</h6>
                                    <span class="text-white small d-block">Double or Nothing</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="p-3 bg-secondary bg-opacity-15 rounded-3 border border-secondary text-center">
                                    <i class="fa-solid fa-gift text-warning fs-5 mb-1"></i>
                                     <?php $free = array_filter($stats['allGames'], fn($g)=>( (int)($g['stake_cost']) <= 0) );  ?>
                                    <h6 class="text-white fw-bold mb-0"><?= (count($free)/($totalGames===0?1:$totalGames))*100 ?>%</h6>
                                    <span class="text-white small d-block">Free Promo ($0.00)</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Admin Dashboard KPI Summary Cards Section End -->                        
                         
                     
                        
                        
 
                    </div>
                
                 
            </div>
        </div>
        
        
        <script>
            function fetchLimit(e) {
                window.location.href = `${e.value}`;
            }
        </script>
        <?php require ADMIN.'includes/footer.inc.php' ?> 
        
 
    </main> 
 
</body>

</html>
