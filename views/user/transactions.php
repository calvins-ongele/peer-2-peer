<?php
    $distinctPurposes = [];
    array_walk_recursive($this->history, function($value, $index) use (&$distinctPurposes) {
        if (($index === 'purpose') && (!empty($value)) ) $distinctPurposes[] = $value;
    }); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'public/includes/header.inc.php' ?>
    <style>
        .text-muted {
            color:whitesmoke !important;

        } 
    </style> 
</head>
<body class="tt-magic-cursor">

    <!-- Preloader Start -->
     <?php require 'public/includes/profile.nav.php' ?>
    <!-- main Header end -->

     

    <!-- Contact Us Page Start -->
    <div class="container">
        
    <!-- Transaction History & Escrow Ledger Section Start -->
<section class="transaction-history-section p-5">
    <div class="container wow FadeinUp">
        
        <!-- Balance & Escrow Overview Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 shadow-sm h-100">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small text-uppercase fw-bold d-block mb-1">Available Balance</span>
                            <h3 class="text-white fw-bold mb-0">$<?= number_format($this->_me['user_balance'],2) ?> <span class="fs-6 text-muted">USD</span></h3>
                        </div>
                        <div class="bg-success bg-opacity-25 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                            <i class="fa-solid fa-wallet fs-4"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-secondary py-2 px-4 d-flex gap-2">
                        <a href="/user/balance" class="btn btn-sm btn-warning fw-bold flex-grow-1"><i class="fa-solid fa-plus me-1"></i> Deposit</a>
                        <a href="/user/balance/withdraw" class="btn btn-sm btn-outline-light flex-grow-1"><i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Withdraw</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 shadow-sm h-100">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small text-uppercase fw-bold d-block mb-1">Locked in Escrow</span>
                            <h3 class="text-warning fw-bold mb-0">$<?= number_format($this->summaries['locked']['locked_amount'],2) ?> <span class="fs-6 text-muted">USD</span></h3>
                        </div>
                        <div class="bg-warning bg-opacity-25 text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                            <i class="fa-solid fa-lock fs-4"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-secondary py-2 px-4">
                        <span class="text-muted small">
                            <i class="fa-solid fa-circle-info me-1 text-warning"></i> Across <?= $this->summaries['locked']['totalActiveGames'] ?> active/disputed game(s)</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 shadow-sm h-100">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small text-uppercase fw-bold d-block mb-1">Total Winnings Paid</span>
                            <h3 class="text-info fw-bold mb-0">$<?= number_format($this->summaries['winnings']['amountWon'] ) ?> <span class="fs-6 text-muted">USD</span></h3>
                        </div>
                        <div class="bg-info bg-opacity-25 text-info rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                            <i class="fa-solid fa-trophy fs-4"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-secondary py-2 px-4">
                        <span class="text-muted small"><i class="fa-solid fa-percent me-1 text-info"></i> Net of <?= PLATFORM_FEE_PC ?>% platform service fee</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction History Table Card -->
        <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 shadow-lg overflow-hidden">
            
            <!-- Header & Filter Controls -->
            <div class="card-header bg-transparent border-secondary p-4">
                <div class="row align-items-center g-3">
                    <div class="col-lg-5">
                        <h4 class="text-white fw-bold mb-1">
                            <i class="fa-solid fa-clock-rotate-left text-warning me-2"></i>Transaction Ledger
                        </h4>
                        <p class="text-muted small mb-0">Immutable audit log of deposits, escrow locks, payouts, and refunds.</p>
                    </div>
                    
                    <div class="col-lg-7">
                        <div class="d-flex flex-wrap justify-content-lg-end gap-2">
                            <!-- Type Filter -->
                            <select class="form-select form-select-sm bg-secondary text-white border-0 w-auto" id="txTypeFilter">
                                <option value="all" selected>All Types</option>
                                <?php foreach ($distinctPurposes as $value) {
                                    echo "<option value='{$value}'>{$value}</option>";
                                } ?>
                                
                            </select>

                            <!-- Search Input -->
                            <div class="input-group input-group-sm w-auto">
                                <span class="input-group-text bg-secondary text-warning border-0"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <input type="text" class="form-control bg-secondary text-white border-0" id="txSearchInput" placeholder="Search Game ID or Ref...">
                            </div>

                            <!-- Export Button -->
                             <!--
                            <button class="btn btn-sm btn-outline-warning" type="button" title="Download CSV Ledger">
                                <i class="fa-solid fa-file-csv me-1"></i> Export
                            </button>-->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Responsive Table -->
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0" id="transactionTable">
                    <thead class="border-secondary text-muted small text-uppercase">
                        <tr>
                            <th class="ps-4 py-3">Transaction ID</th>
                            <th class="py-3">Type</th>
                            <th class="py-3">Reference / Game</th>
                            <th class="py-3">Date & Time</th>
                            <th class="py-3">Status</th>
                            <th class="pe-4 py-3 text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="border-secondary">
                        
                        <?php foreach($this->history['data'] as $index => $row) { ?>
                        <!-- Row <?= $index + 1 ?>: Completed Game <?= $row['purpose'] ?> -->
                        <tr data-type="<?= $row['purpose'] ?>">
                            <td class="ps-4 font-monospace small text-white-50">#TXN-<?= strtotime($row['created_at']) ?></td>
                            <td>
                                <span class="badge bg-success bg-opacity-25 text-<?= $row['dr_cr']==='cr'?'success':'danger' ?> border border-success px-2 py-1">
                                    <?= $row['purpose'] ?>
                                </span>
                            </td>
                            <td>
                                <div class="fw-medium text-white"><?= $row['title']??'' ?></div>
                                <?= empty($row['game_url'])?'':"<a href='/user/games/{$row['game_url']}' class='text-warning small text-decoration-none'>#{$row['game_url']}</a>" ?>
                                 
                            </td>
                            <td class="text-muted small"><?= date('M d, Y • H:i', strtotime($row['created_at'])) ?></td>
                            <td>
                                <span class="text-success small fw-medium"><i class="fa-solid fa-circle-check me-1"></i>Settled</span>
                            </td>
                            <td class="pe-4 text-end fw-bold text-<?= $row['dr_cr']==='cr'?'success':'danger' ?>"><?= $row['dr_cr']==='cr'?'+':'-' ?>$<?= $row['amount'] ?></td>
                        </tr>
                        <?php } ?>
 
                        

                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            <div class="card-footer bg-transparent border-secondary px-4 py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                <span class="text-muted small">Showing <strong>1–<?= count($this->history['data']) ?></strong> of <strong><?= $this->history['count'] ?></strong> ledger entries</span>
                <nav aria-label="Transaction history pagination">
                    <ul class="pagination pagination-sm mb-0">
                       

                         <?php
        $currentPage  = max(1, (int) ($_GET['pg'] ?? 1));
        $totalPerPage = max(1, (int) ($this->_settings['user_loop_sequence'] ?? 24));
        $totalCount   = max(0, (int) ($this->history['count'] ?? 0));

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
                    <a class="page-link bg-dark border-secondary text-muted" href="<?= CustomFunctions::formatDynamicUrl('pg', (string) ($currentPage - 1)) ?>" tabindex="-1">Previous</a>
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

        </div>
    </div>
</section>

<!-- Lightweight Client-Side Filter & Search Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const typeFilter = document.getElementById('txTypeFilter');
    const searchInput = document.getElementById('txSearchInput');
    const rows = document.querySelectorAll('#transactionTable tbody tr');

    function filterTransactions() {
        const selectedType = typeFilter.value;
        const searchTerm = searchInput.value.toLowerCase().trim();

        rows.forEach(row => {
            const rowType = row.getAttribute('data-type');
            const rowText = row.textContent.toLowerCase();

            const matchesType = (selectedType === 'all' || rowType === selectedType);
            const matchesSearch = rowText.includes(searchTerm);

            row.style.display = (matchesType && matchesSearch) ? '' : 'none';
        });
    }

    typeFilter?.addEventListener('change', filterTransactions);
    searchInput?.addEventListener('input', filterTransactions);
});
</script>
<!-- Transaction History & Escrow Ledger Section End -->
        
     
    </div> 
 

    <!-- Contact Us Page End -->
 
    <script> 

         
        

    </script>

    <?php require 'public/includes/footer.inc.php' ?>
</body>
</html>