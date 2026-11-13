<?php
$choices = $this->game['choices'];
$game = $this->game['game'];
$players = $this->game['players'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'public/includes/header.inc.php' ?>
    <style>
        .text-muted {
            color: whitesmoke !important;

        }
    </style>
</head>

<body class="tt-magic-cursor">

        <!-- Preloader Start -->
        <?php require 'public/includes/navbar.inc.php' ?>
        <!-- main Header end -->

    <!-- Contact Us Page Start -->
    <div class="container">

        <!-- Game Details & Player Invitation Section Start -->
        <section class="game-details-section py-5">
            <div class="container">
                <!-- Back Navigation & Header -->
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 class="text-white fw-bold mt-1 mb-2"><?= ($game['title']) ?></h2>
                    <div class="d-flex gap-2">
                        <span class="badge bg-warning text-dark fs-6 px-3 py-2 fw-bold d-flex align-items-center">
                            <i class="fa-solid fa-bolt me-2"></i><?= ucwords(str_replace('_', ' ', $game['status'])) ?>
                        </span>
                        <span class="badge bg-secondary text-uppercase fs-6 px-3 py-2 d-flex align-items-center">
                            <?= ucwords($game['game_type']) ?> Match
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
                                        <span class="text-warning small text-uppercase fw-bold tracking-wider">Game ID: #<?= ($game['game_url']) ?></span>
                                        
                                        <p class="text-muted mb-0" style="height: 100px; overflow:auto">
                                            <?= $game['description'] ?>
                                        </p>
                                    </div>
                                </div>

                                <hr class="border-secondary opacity-50 my-4">

                                <!-- Game Parameter Highlights -->
                                <div class="row g-3 text-center">
                                    <div class="col-sm-4 col-6">
                                        <div class="bg-secondary bg-opacity-15 p-3 rounded-3 border border-secondary">
                                            <span class="text-muted small d-block mb-1">Required Stake</span>
                                            <h4 class="text-primary fw-bold mb-0" style="color:rgba(5, 220, 10,9)!important">$<?= $game['stake_cost'] ?> <span class="fs-6 text-muted">USD</span></h4>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-6">
                                        <div class="bg-secondary bg-opacity-15 p-3 rounded-3 border border-secondary">
                                            <span class="text-muted small d-block mb-1">Total Escrow Pot</span>
                                            <?php $acceptedInvestors = array_filter($players, fn($r) => ($r['player_accepted_invitation'] ?? '') === 'accepted');
                                            $totalInvestment = count($acceptedInvestors) *  $game['stake_cost'] ?>
                                            <h4 class="text-warning fw-bold mb-0">$<?= $totalInvestment ?> <span class="fs-6 text-muted">USD</span></h4>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-12">
                                        <div class="bg-secondary bg-opacity-15 p-3 rounded-3 border border-secondary">
                                            <span class="text-muted small d-block mb-1">Double or Nothing</span>
                                            <h4 class="text-<?= $game['is_double_or_nothing'] ? 'info' : 'danger' ?> fw-bold mb-0"><i class="fa-solid fa-<?= $game['is_double_or_nothing'] ? 'circle-check' : 'times-circle' ?> me-1"></i><?= $game['is_double_or_nothing'] ? 'Enable' : 'Disabled' ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Outcome Choices Selection Card -->
                        <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 shadow-lg mb-4">
                            <div class="card-header bg-transparent border-secondary py-3 px-4 d-flex justify-content-between align-items-center">
                                <h5 class="text-white fw-bold mb-0">
                                    <i class="fa-solid fa-list-check text-warning me-2"></i>Defined Choices
                                </h5>
                                <span class="text-muted small">Select your choice to commit stake if not yet</span>
                            </div>
                            <div class="card-body p-4">
                                <div class="list-group gap-3" id="choicesSelectionGroup">
                                    <form id="saveChoice">
                                        <input name="csrf_token" value="<?= CSRF::get() ?>" type="hidden" />
                                        <input name="method" value="saveYourPlayChoice" type="hidden" />
                                        <input name="game_url" value="<?= $game['game_url'] ?>" type="hidden" />


                                        <!-- Choice Option 1 -->
                                        <?php
                                        $mychoice = '';
                                        foreach ($choices as $index => $choice) {
                                            $IvePlayed = array_filter($players, fn($r) => ($r['player_user_id'] ?? '') === 'no needed');
                                            $mychoice = ($IvePlayed[0]['answer_chosen'] ?? 0) === $choice['id'] ? 'checked' : ''; //checked means I've played

                                            $howManyHaveChosenThis = array_filter($players, fn($r) => ($r['answer_chosen'] ?? '') === $choice['id']);
                                            $border = 'border-secondary';
                                            if ($mychoice === 'checked') $border = 'border-warning';
                                        ?>
                                            <label class="list-group-item bg-secondary bg-opacity-15 rounded-3 text-light p-3 d-flex align-items-center justify-content-between cursor-pointer mb-1 <?= $border ?>">
                                                <div class="d-flex align-items-center gap-3">
                                                    <input rel='<?= $choice['choice_details'] ?>' class="choicesradio form-check-input bg-dark border-warning" type="radio" name="answer_chosen" id="choice<?= $choice['id'] ?>" value="<?= $choice['id'] ?>" <?= $mychoice ?> />
                                                    <div>
                                                        <h6 class="text-white fw-bold mb-0">
                                                            Choice #<?= $index + 1 ?>: <?= $choice['choice_details'] ?>
                                                        </h6>
                                                        <span class="text-muted small">Selected by <?= count($howManyHaveChosenThis) ?> player(s)</span>
                                                    </div>
                                                </div>
                                                <?php if ($mychoice === 'checked') { ?>
                                                    <span class="badge bg-warning text-dark fw-bold px-3 py-2"><i class="fa-solid fa-user-check me-1"></i> Your Selection</span>
                                                <?php } ?>
                                                <?php if (count($howManyHaveChosenThis) === 0) { ?>
                                                    <span class="badge bg-dark border border-secondary text-muted px-3 py-2">Open Choice</span>
                                                <?php } ?>
                                            </label>
                                        <?php } ?> 
                                    
                                        <div class="mt-3 feedback "></div>
                                        <div class=" d-flex justify-content-end">
                                            
                                        <?php 

                                        if (! in_array($game['status'], ['overriden_by_admin','abandoned_after_start','cancelled_b4_start'])) { ?>
                                            <a class="btn btn-xsm btn-success" href="/account?return=<?= urlencode("/user/games/{$game['game_url']}") ?>" style="border-color: var(--secondary-color);"
                                            ><?= ($game['status'] === 'completed') ? 'Vote Now' : 'Save your Choice' ?></a>
                                        <?php } ?>
                                        </div>
                                       
                                    </form>

                                </div>

                                <div class="mt-4 p-3 bg-dark border border-secondary rounded-3 d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-2 text-muted small">
                                        <i class="fa-solid fa-shield-halved text-warning fs-5"></i>
                                        <span>Publicly Provable: <strong><?= $game['can_be_publicly_proven']?'Yes':'No'  ?></strong></span>
                                    </div>
                                    <button class="btn btn-sm btn-outline-warning" data-bs-toggle="collapse" data-bs-target="#evidenceCollapse">
                                        <i class="fa-solid fa-link me-1"></i> View Proof
                                    </button>
                                </div>

                                <!-- Evidence Collapse Area -->
                                <div class="collapse mt-3" id="evidenceCollapse">
                                    <div class="card card-body bg-secondary bg-opacity-25 border-secondary text-light">
                                        <span class="text-muted small d-block mb-1">Evidence Reference Details:</span>
                                        <?= CustomFunctions::linkify($game['evidence_4_disputes']) ?>
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
                                    <i class="fa-solid fa-user-plus text-warning me-2"></i>Invite Player(s)
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <p class="text-muted small mb-3">Share the direct invitation link or send an invite directly by user ID/email.</p>

                                <!-- Shareable Link Input -->
                                <div class="mb-4">
                                    <label class="form-label text-light fw-medium small">Shareable Invite Link</label>
                                    <div class="input-group">
                                        <?php $gameUrl = "https://{$_SERVER['SERVER_NAME']}/games/{$game['game_url']}?invite="; ?>
                                        <input type="text" class="form-control bg-secondary text-white border-0 py-2 small" id="gameInviteLink" value="<?= $gameUrl ?>" readonly>
                                        <button onclick="copy(`<?= $gameUrl ?>`)" class="btn btn-warning fw-bold px-3" type="button" id="copyLinkBtn">
                                            <i class="fa-solid fa-copy me-1"></i> Copy
                                        </button>
                                    </div>
                                    <div id="copySuccessMsg" class="form-text text-success d-none"><i class="fa-solid fa-circle-check me-1"></i> Copied to clipboard!</div>
                                </div>

                                <!-- Direct Invite Form -->
                                <form id="directInviteForm">
                                        <input name="csrf_token" value="<?= CSRF::get() ?>" type="hidden" />
                                        <input name="method" value="invitePlayer" type="hidden" />
                                        <input name="game_url" value="<?= $game['game_url'] ?>" type="hidden" />

                                    <div class="mb-3">
                                        <label for="inviteUserInput" class="form-label text-light fw-medium small">Invite by Username or Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-dark text-warning border-secondary"><i class="fa-solid fa-at"></i></span>
                                            <input type="text" name="username" class="form-control bg-secondary text-white border-0 py-2" id="inviteUserInput" placeholder="e.g., Alex24 or alex@email.com" required>
                                        </div>
                                    </div>
                                    <div class="inviteFeedback form-text  mb-2"></div>
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
                                    <i class="fa-solid fa-users text-warning me-2"></i>Players
                                </h5>
                                <span class="badge bg-secondary"><?= count($acceptedInvestors) ?> / <?= count($players) ?> Joined</span>
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex flex-column gap-3">

                                    <!-- Player 1: Host (You) -->
                                     <?php foreach($players as $player){ 
                                        $username = CustomFunctions::maskString($player['username']??'', 3);
                                        $status = CustomFunctions::playerStatus($player['player_accepted_invitation']); 
                                    ?>
                                    <div class="d-flex align-items-center justify-content-between p-3 bg-secondary bg-opacity-15 rounded-3 border border-secondary">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="position-relative">
                                                <div class="bg-warning text-dark fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                                    <?= substr($username,0,1) ?>
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="text-white fw-bold mb-0" >
                                                    <?= ($username) ?>
                                                </h6>
                                                
                                                    <?= (!empty($player['choice_details']))?
                                                    "<span class='text-warning small'><i class='fa-solid fa-circle-check me-1'></i>
                                                    Choice: {$player['choice_details']} </span>"
                                                    :'<span class="text-muted small">Invitation Pending...</span>' ?>
                                                
                                            </div>
                                        </div>
                                        <span class="badge <?= $status['color'] ?> fw-medium px-2 py-1"><i class="fa-solid <?= $status['icon'] ?> me-1"></i> <?= $player['player_accepted_invitation'] ?></span>
                                    </div>
                                    <?php } ?>

                                    

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>


        <!-- Game Details & Player Invitation Section End -->
        <script> 
          

            const directInviteForm = document.querySelector('#directInviteForm');
            const inviteSubmitBtn = directInviteForm.querySelector('button[type="submit"]');
            const inviteBtnContent = inviteSubmitBtn.innerHTML;
            const inviteFeedback = document.querySelector('.inviteFeedback');

            directInviteForm.addEventListener('submit', async (e)=> {
                e.preventDefault();
                inviteFeedback.textContent = '';
                inviteFeedback.classList.remove('text-success', 'text-danger');
                inviteSubmitBtn.disabled = true;
                inviteSubmitBtn.innerHTML = `<div class="spinner-border"role="status"><span class="visually-hidden">Loading...</span></div>`;
                const form = new FormData(directInviteForm);
                const username = document.querySelector('input[name="username"]');

                try {
                    const response = await fetch('/myapp/requests', {method:"POST", body:form});
                    const result = await response.json();
                    if ((!response.ok) || result.error) {
                        throw new Error(result.msg || "Something went wrong. Please try again.");
                    }

                    inviteFeedback.classList.add('text-success');
                    inviteFeedback.textContent = result.msg || `${username.value || ''} was successfully invited.`;
                    username.value = "";

                } catch (error) { 
                    console.log(error);
                    showToast(error);
                    inviteFeedback.classList.add('text-danger');
                    inviteFeedback.textContent = error;
                } finally {
                    inviteSubmitBtn.disabled = false;
                    inviteSubmitBtn.innerHTML = inviteBtnContent;
                }


                
                
            });


        </script>

    </div>


    <!-- Contact Us Page End -->


    <?php require 'public/includes/footer.inc.php' ?>
</body>

</html>