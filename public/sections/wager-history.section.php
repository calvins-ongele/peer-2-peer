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
                <div class="row g-4">
                    
                    <!-- CARD 1: Active Match (In Progress) -->
                    <div class="col-lg-6 col-12">
                        <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 h-100 shadow-sm">
                            <div class="card-header bg-transparent border-secondary d-flex justify-content-between align-items-center py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-warning text-dark fw-bold"><i class="fa-solid fa-bolt me-1"></i>In Progress</span>
                                    <span class="badge bg-secondary text-uppercase">Private</span>
                                </div>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i>Created 2h ago</span>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title text-white fw-bold mb-2">Lakers vs Celtics Game 7 Winner</h5>
                                <p class="card-text text-muted small mb-3">Head-to-head match challenge on tonight's playoff match outcome.</p>

                                <div class="row g-2 mb-3 bg-dark bg-opacity-15 p-3 rounded-3 border border-secondary">
                                    <div class="col-6">
                                        <div class="text-muted small">Your Selection:</div>
                                        <div class="fw-bold text-warning"><i class="fa-solid fa-circle-check me-1"></i>Lakers Win</div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="text-muted small">Stake Amount:</div>
                                        <div class="fw-bold text-success fs-6">$50.00 USD</div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between text-muted small">
                                    <span><i class="fa-solid fa-user-shield me-1 text-info"></i>Opponent: <strong>@Alex24</strong></span>
                                    <span class="badge bg-outline-secondary border text-light"><i class="fa-solid fa-scale-unbalanced me-1"></i>Escrow Locked</span>
                                </div>
                            </div>

                            <div class="card-footer bg-transparent border-secondary d-flex justify-content-between align-items-center py-3">
                                <a href="#" class="btn btn-sm btn-outline-warning fw-medium"><i class="fa-solid fa-eye me-1"></i> View Details</a>
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Open Dispute"><i class="fa-solid fa-triangle-exclamation me-1"></i> Dispute</button>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 2: Disputed Match (Under Admin Review) -->
                    <div class="col-lg-6 col-12">
                        <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 h-100 shadow-sm border-danger">
                            <div class="card-header bg-transparent border-secondary d-flex justify-content-between align-items-center py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-danger text-white fw-bold"><i class="fa-solid fa-triangle-exclamation me-1"></i>Disputed</span>
                                    <span class="badge bg-secondary text-uppercase">Public</span>
                                </div>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i>Updated 1d ago</span>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title text-white fw-bold mb-2">FC Barcelona vs Real Madrid El Clasico</h5>
                                <p class="card-text text-muted small mb-3">Opponent claimed draw, but evidence submitted shows 2-1 final score.</p>

                                <div class="row g-2 mb-3 bg-dark bg-opacity-15 p-3 rounded-3 border border-secondary">
                                    <div class="col-6">
                                        <div class="text-muted small">Your Selection:</div>
                                        <div class="fw-bold text-warning"><i class="fa-solid fa-circle-check me-1"></i>FC Barcelona</div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="text-muted small">Total Pot:</div>
                                        <div class="fw-bold text-success fs-6">$200.00 USD</div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between text-muted small">
                                    <span><i class="fa-solid fa-link me-1 text-warning"></i>Proof URL Submitted</span>
                                    <span class="badge bg-danger bg-opacity-25 text-danger border border-danger">Awaiting Admin Override</span>
                                </div>
                            </div>

                            <div class="card-footer bg-transparent border-secondary d-flex justify-content-between align-items-center py-3">
                                <a href="#" class="btn btn-sm btn-warning fw-bold text-dark"><i class="fa-solid fa-file-contract me-1"></i> Track Dispute</a>
                                <span class="text-muted small">ID: #GAME-8921</span>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 3: Pending Invitation (Private Invite Received) -->
                    <div class="col-lg-6 col-12">
                        <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 h-100 shadow-sm">
                            <div class="card-header bg-transparent border-secondary d-flex justify-content-between align-items-center py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-info text-dark fw-bold"><i class="fa-solid fa-envelope me-1"></i>Invite Received</span>
                                    <span class="badge bg-secondary text-uppercase">Private</span>
                                </div>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i>Expires in 12h</span>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title text-white fw-bold mb-2">FIFA 24 Ultimate Team Tournament</h5>
                                <p class="card-text text-muted small mb-3">Challenged by <strong>@ProGamer99</strong>. Select your choice to lock match.</p>

                                <div class="row g-2 mb-3 bg-dark bg-opacity-15 p-3 rounded-3 border border-secondary">
                                    <div class="col-6">
                                        <div class="text-muted small">Challenger:</div>
                                        <div class="fw-bold text-white">@ProGamer99</div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="text-muted small">Required Stake:</div>
                                        <div class="fw-bold text-success fs-6">$25.00 USD</div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between text-muted small">
                                    <span><i class="fa-solid fa-arrows-rotate me-1 text-warning"></i>Double or Nothing Enabled</span>
                                </div>
                            </div>

                            <div class="card-footer bg-transparent border-secondary d-flex justify-content-between align-items-center py-3">
                                <div class="btn-group gap-2">
                                    <button class="btn btn-sm btn-success fw-bold px-3"><i class="fa-solid fa-check me-1"></i> Accept</button>
                                    <button class="btn btn-sm btn-outline-secondary text-light px-3"><i class="fa-solid fa-xmark me-1"></i> Decline</button>
                                </div>
                                <a href="#" class="btn btn-sm btn-link text-muted p-0 text-decoration-none">View Terms</a>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 4: Completed Game (Won) -->
                    <div class="col-lg-6 col-12">
                        <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 h-100 shadow-sm opacity-75">
                            <div class="card-header bg-transparent border-secondary d-flex justify-content-between align-items-center py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-success text-white fw-bold"><i class="fa-solid fa-trophy me-1"></i>Won</span>
                                    <span class="badge bg-secondary text-uppercase">Public</span>
                                </div>
                                <span class="text-muted small"><i class="fa-solid fa-calendar-check me-1"></i>3 days ago</span>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title text-white fw-bold mb-2">Bitcoin Price above $70k by Nov 10</h5>
                                <p class="card-text text-muted small mb-3">Publicly proven outcome verified via official exchange index.</p>

                                <div class="row g-2 mb-3 bg-dark bg-opacity-15 p-3 rounded-3 border border-secondary">
                                    <div class="col-6">
                                        <div class="text-muted small">Winning Choice:</div>
                                        <div class="fw-bold text-success"><i class="fa-solid fa-circle-check me-1"></i>Yes (Above $70k)</div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="text-muted small">Payout Collected:</div>
                                        <div class="fw-bold text-success fs-6">+$100.00 USD</div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between text-muted small">
                                    <span><i class="fa-solid fa-shield-check text-success me-1"></i>Publicly Proven</span>
                                    <span class="text-muted">Status: Completed</span>
                                </div>
                            </div>

                            <div class="card-footer bg-transparent border-secondary d-flex justify-content-between align-items-center py-3">
                                <a href="#" class="btn btn-sm btn-outline-secondary text-light"><i class="fa-solid fa-receipt me-1"></i> View Receipt</a>
                                <span class="text-muted small">ID: #GAME-7104</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Profile Active & Past Games Section End -->