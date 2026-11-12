<!-- Profile Active & Past Games Section Start -->
<section class="profile-games-section py-5">
    <div class="container">
        <!-- Section Header & Filter Navigation -->
        <div class="row align-items-center mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
                <h3 class="text-white fw-bold mb-1">
                    <i class="fa-solid fa-gamepad text-warning me-2"></i>My Wager Games
                </h3>
                <p class="text-muted small mb-0">Track your active matches, invitations, and wager history.</p>
            </div>
            <div class="col-md-6">
                <!-- Filter Pills -->
                <ul class="nav nav-pills justify-content-md-end gap-2" id="gameStatusTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active bg-dark text-warning border border-secondary btn-sm px-3 fw-medium" id="tab-all" data-bs-toggle="pill" data-bs-target="#content-all" type="button" role="tab">All Games</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link bg-dark text-light border border-secondary btn-sm px-3 fw-medium position-relative" id="tab-active" data-bs-toggle="pill" data-bs-target="#content-active" type="button" role="tab">
                            Active
                            <span class="badge rounded-pill bg-warning text-dark ms-1">2</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link bg-dark text-light border border-secondary btn-sm px-3 fw-medium" id="tab-pending" data-bs-toggle="pill" data-bs-target="#content-pending" type="button" role="tab">Invites</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link bg-dark text-light border border-secondary btn-sm px-3 fw-medium" id="tab-completed" data-bs-toggle="pill" data-bs-target="#content-completed" type="button" role="tab">History</button>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Tab Contents -->
        <div class="tab-content" id="gameStatusTabsContent">
            <div class="tab-pane fade show active" id="content-all" role="tabpanel">
                <div class="row g-4"> <?php //echo "<pre>";print_r($this->games); echo"</pre>"; ?>
                    
                   <?php foreach($this->games['games'] as $index => $game ) {  
                        $gameStatus = CustomFunctions::gameStatus( $game['status']); 
                        $status = '';
                        if ((($game['status'] == 'completed')||($game['status'] == 'overriden_by_admin')) && ($game['is_winner']) ){$status = 'won';}
                        if ((($game['status'] == 'completed')||($game['status'] == 'overriden_by_admin')) && (!$game['is_winner']) ){$status = 'lost';}
                        if (($game['status'] == 'pending') || ($game['status'] == 'in_progress') || ($game['status'] == 'disputed')){$status = 'pending';}
                        $winStatus = CustomFunctions::winStatus( $status );
                    ?>
                    <!-- CARD 1: Active Match (In Progress) -->
                    <div class="col-lg-6 col-12">
                        <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 h-100 shadow-sm">
                            <div class="card-header bg-transparent border-secondary d-flex justify-content-between align-items-center py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge <?= $winStatus['bg-color'] ?> text-dark fw-bold text-uppercase">
                                        <i class="fa-solid <?= $winStatus['icon'] ?> me-1"></i><?= $winStatus['text'] ?>
                                    </span>
                                    <span class="badge bg-secondary text-uppercase"><?= $game['game_type'] ?></span>
                                </div>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i>Created <?= CustomFunctions::timeago($game['created_at']) ?></span>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title text-white fw-bold mb-2"><?= $game['title'] ?></h5>
                                <p class="card-text text-muted small mb-3" style="height: 75px; overflow:auto"><?= $game['description'] ?></p>

                                <div class="row g-2 mb-3 bg-dark bg-opacity-15 p-3 rounded-3 border border-secondary">
                                    <div class="col-6">
                                        <div class="text-muted small">Your Selection:</div>
                                        <div class="fw-bold text-warning"><i class="fa-solid fa-circle-check me-1"></i><?= $game['choice_details'] ?></div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="text-muted small">Stake Amount:</div>
                                        <div class="fw-bold text-success fs-6">$<?= $game['stake_cost'] ?> USD</div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between text-muted small">
                                    <span><i class="fa-solid fa-user-shield me-1 text-info"> 
                                        </i>Opponent: <strong><?= $game['total_players'] ?> Player(s)</strong>
                                    </span>
                                    <span class="badge bg-outline-secondary border text-light">
                                        <?= ($game['status']=='disputed') ? '<i class="fa-solid fa-scale-unbalanced me-1"></i>Escrow Locked</span>':''?>
                                </div>
                            </div>

                            <?php if ($game['player_accepted_invitation']==='pending') { ?>
                            <div class="card-footer bg-transparent border-secondary d-flex justify-content-between align-items-center py-3">
                                <div class="btn-group gap-2">
                                    <a href="/user/games/<?= $game['game_url'] ?>#choices" class="btn btn-sm btn-success fw-bold px-3"><i class="fa-solid fa-check me-1"></i> Accept</a>
                                    <button class="btn btn-sm btn-outline-secondary text-light px-3" onclick="rejectInvitation(`<?= $game['id'] ?>`,`<?= $game['title'] ?>`);return false;">
                                        <i class="fa-solid fa-xmark me-1"></i> Decline
                                    </button>
                                </div>
                                <a href="/legal/terms-of-use" class="btn btn-sm btn-link text-muted p-0 text-decoration-none">View Terms</a>
                            </div>
                            <?php } else { ?>
                            
                            <div class="card-footer bg-transparent border-secondary d-flex justify-content-between align-items-center py-3">
                                <a href="/user/games/<?= $game['game_url'] ?>" class="btn btn-sm btn-outline-warning fw-medium">
                                    <i class="fa-solid fa-eye me-1"></i> View Details</a>
                                <button class="btn btn-sm <?= $gameStatus['color'] ?>" data-bs-toggle="tooltip"  >
                                    <i class="fa-solid <?= $gameStatus['icon'] ?> me-1"></i> <?= $gameStatus['text'] ?></button>
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                    <?php } ?>
 

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Profile Active & Past Games Section End -->