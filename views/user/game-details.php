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

        <!-- Game Details & Player Invitation Section Start -->
<section class="game-details-section py-5">
    <div class="container">
        <!-- Back Navigation & Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <a href="#" class="btn btn-outline-secondary text-light btn-sm">
                <i class="fa-solid fa-arrow-left me-2"></i> Back to Dashboard
            </a>
            <div class="d-flex gap-2">
                <span class="badge bg-warning text-dark fs-6 px-3 py-2 fw-bold d-flex align-items-center">
                    <i class="fa-solid fa-bolt me-2"></i> In Progress
                </span>
                <span class="badge bg-secondary text-uppercase fs-6 px-3 py-2 d-flex align-items-center">
                    Private Match
                </span>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Column: Game Information & Choices -->
            <div class="col-lg-7 col-12">
                <!-- Game Header Card -->
                <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 shadow-lg mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="text-warning small text-uppercase fw-bold tracking-wider">Game ID: #GAME-8921</span>
                                <h2 class="text-white fw-bold mt-1 mb-2">Lakers vs Celtics Game 7 Winner</h2>
                                <p class="text-muted mb-0">Head-to-head playoff match challenge. First team to score higher at full time wins the escrow pot.</p>
                            </div>
                        </div>

                        <hr class="border-secondary opacity-50 my-4">

                        <!-- Game Parameter Highlights -->
                        <div class="row g-3 text-center">
                            <div class="col-sm-4 col-6">
                                <div class="bg-secondary bg-opacity-15 p-3 rounded-3 border border-secondary">
                                    <span class="text-muted small d-block mb-1">Required Stake</span>
                                    <h4 class="text-success fw-bold mb-0">$50.00 <span class="fs-6 text-muted">USD</span></h4>
                                </div>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="bg-secondary bg-opacity-15 p-3 rounded-3 border border-secondary">
                                    <span class="text-muted small d-block mb-1">Total Escrow Pot</span>
                                    <h4 class="text-warning fw-bold mb-0">$100.00 <span class="fs-6 text-muted">USD</span></h4>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="bg-secondary bg-opacity-15 p-3 rounded-3 border border-secondary">
                                    <span class="text-muted small d-block mb-1">Double or Nothing</span>
                                    <h4 class="text-info fw-bold mb-0"><i class="fa-solid fa-circle-check me-1"></i> Enabled</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Outcome Choices Selection Card -->
                <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 shadow-lg mb-4">
                    <div class="card-header bg-transparent border-secondary py-3 px-4 d-flex justify-content-between align-items-center">
                        <h5 class="text-white fw-bold mb-0">
                            <i class="fa-solid fa-list-check text-warning me-2"></i>Defined Choices (`choices`)
                        </h5>
                        <span class="text-muted small">Select your choice to commit stake</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="list-group gap-3" id="choicesSelectionGroup">
                            
                            <!-- Choice Option 1 -->
                            <label class="list-group-item bg-secondary bg-opacity-15 border-secondary rounded-3 text-light p-3 d-flex align-items-center justify-content-between cursor-pointer border-warning">
                                <div class="d-flex align-items-center gap-3">
                                    <input class="form-check-input bg-dark border-warning" type="radio" name="answer_chosen" id="choice1" value="101" checked>
                                    <div>
                                        <h6 class="text-white fw-bold mb-0">Choice #1: Lakers Win</h6>
                                        <span class="text-muted small">Selected by 1 player</span>
                                    </div>
                                </div>
                                <span class="badge bg-warning text-dark fw-bold px-3 py-2"><i class="fa-solid fa-user-check me-1"></i> Your Selection</span>
                            </label>

                            <!-- Choice Option 2 -->
                            <label class="list-group-item bg-secondary bg-opacity-15 border-secondary rounded-3 text-light p-3 d-flex align-items-center justify-content-between cursor-pointer">
                                <div class="d-flex align-items-center gap-3">
                                    <input class="form-check-input bg-dark border-secondary" type="radio" name="answer_chosen" id="choice2" value="102">
                                    <div>
                                        <h6 class="text-white fw-bold mb-0">Choice #2: Celtics Win</h6>
                                        <span class="text-muted small">Awaiting Opponent selection</span>
                                    </div>
                                </div>
                                <span class="badge bg-dark border border-secondary text-muted px-3 py-2">Open Choice</span>
                            </label>

                        </div>

                        <div class="mt-4 p-3 bg-dark border border-secondary rounded-3 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2 text-muted small">
                                <i class="fa-solid fa-shield-halved text-warning fs-5"></i>
                                <span>Publicly Provable: <strong>Yes (`can_be_publicly_proven = 1`)</strong></span>
                            </div>
                            <button class="btn btn-sm btn-outline-warning" data-bs-toggle="collapse" data-bs-target="#evidenceCollapse">
                                <i class="fa-solid fa-link me-1"></i> View Proof URL
                            </button>
                        </div>

                        <!-- Evidence Collapse Area -->
                        <div class="collapse mt-3" id="evidenceCollapse">
                            <div class="card card-body bg-secondary bg-opacity-25 border-secondary text-light">
                                <span class="text-muted small d-block mb-1">Evidence Reference URL (`evidence_4_disputes`):</span>
                                <a href="https://official-stats.com/nba/game/78912" target="_blank" class="text-warning text-break small">
                                    https://official-stats.com/nba/game/78912 <i class="fa-solid fa-arrow-up-right-from-square ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Player Roster & Invitation Portal -->
            <div class="col-lg-5 col-12">
                
                <!-- Invite Players Card -->
                <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 shadow-lg mb-4">
                    <div class="card-header bg-transparent border-secondary py-3 px-4">
                        <h5 class="text-white fw-bold mb-0">
                            <i class="fa-solid fa-user-plus text-warning me-2"></i>Invite Opponent
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted small mb-3">Share the direct invitation link or send an invite directly by user ID/email.</p>
                        
                        <!-- Shareable Link Input -->
                        <div class="mb-4">
                            <label class="form-label text-light fw-medium small">Shareable Invite Link</label>
                            <div class="input-group">
                                <input type="text" class="form-control bg-secondary text-white border-0 py-2 small" id="gameInviteLink" value="https://[company_name].com/game/join/8921?invite=pt_991823" readonly>
                                <button class="btn btn-warning fw-bold px-3" type="button" id="copyLinkBtn">
                                    <i class="fa-solid fa-copy me-1"></i> Copy
                                </button>
                            </div>
                            <div id="copySuccessMsg" class="form-text text-success d-none"><i class="fa-solid fa-circle-check me-1"></i> Copied to clipboard!</div>
                        </div>

                        <!-- Direct Invite Form -->
                        <form id="directInviteForm">
                            <div class="mb-3">
                                <label for="inviteUserInput" class="form-label text-light fw-medium small">Invite by Username or Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-warning border-secondary"><i class="fa-solid fa-at"></i></span>
                                    <input type="text" class="form-control bg-secondary text-white border-0 py-2" id="inviteUserInput" placeholder="e.g., Alex24 or alex@email.com" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-warning w-100 fw-bold py-2">
                                <i class="fa-solid fa-paper-plane me-2"></i> Send Private Invitation
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Match Players Roster Card -->
                <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 shadow-lg">
                    <div class="card-header bg-transparent border-secondary py-3 px-4 d-flex justify-content-between align-items-center">
                        <h5 class="text-white fw-bold mb-0">
                            <i class="fa-solid fa-users text-warning me-2"></i>Players (`players`)
                        </h5>
                        <span class="badge bg-secondary">1 / 2 Joined</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex flex-column gap-3">
                            
                            <!-- Player 1: Host (You) -->
                            <div class="d-flex align-items-center justify-content-between p-3 bg-secondary bg-opacity-15 rounded-3 border border-secondary">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="position-relative">
                                        <div class="bg-warning text-dark fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                            YOU
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="text-white fw-bold mb-0">Host (You)</h6>
                                        <span class="text-warning small"><i class="fa-solid fa-circle-check me-1"></i>Choice: Lakers Win</span>
                                    </div>
                                </div>
                                <span class="badge bg-success text-white fw-medium px-2 py-1"><i class="fa-solid fa-check me-1"></i> Accepted</span>
                            </div>

                            <!-- Player 2: Invited Opponent (Pending) -->
                            <div class="d-flex align-items-center justify-content-between p-3 bg-secondary bg-opacity-15 rounded-3 border border-secondary border-dashed">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-dark text-muted fw-bold rounded-circle border border-secondary d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                        <i class="fa-solid fa-user-clock fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-white-50 fw-bold mb-0">@Alex24</h6>
                                        <span class="text-muted small">Invitation Pending...</span>
                                    </div>
                                </div>
                                <span class="badge bg-warning bg-opacity-25 text-warning border border-warning px-2 py-1"><i class="fa-solid fa-spinner fa-spin me-1"></i> Pending</span>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Copy Link Script -->
<script>
document.getElementById('copyLinkBtn')?.addEventListener('click', function () {
    const copyInput = document.getElementById('gameInviteLink');
    copyInput.select();
    copyInput.setSelectionRange(0, 99999); // Mobile compatibility
    navigator.clipboard.writeText(copyInput.value);

    const msg = document.getElementById('copySuccessMsg');
    msg.classList.remove('d-none');
    setTimeout(() => msg.classList.add('d-none'), 3000);
});
</script>
<!-- Game Details & Player Invitation Section End -->
        
     
    </div> 
 

    <!-- Contact Us Page End -->
 

    <?php require 'public/includes/footer.inc.php' ?>
</body>
</html>