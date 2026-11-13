<?php
$choices = $this->game['choices'];
$game = $this->game['game'];
$players = $this->game['players'];
$me = $this->_me;
// $arr = [ ['name'=>'John', 'age'=>50], ['name'=>'Jane', 'age'=>20], ['name'=>'Doe', 'age'=>100 ]  ];
// $mePlaying = array_filter($arr, fn($p)=> $p['age'] > 20 );
// echo "<pre>";
// print_r($mePlaying);
// echo "</pre>";
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
    <?php require 'public/includes/profile.nav.php' ?>
    <!-- main Header end -->



    <!-- Contact Us Page Start -->
    <div class="container">

        <!-- Game Details & Player Invitation Section Start -->
        <section class="game-details-section py-5">
            <div class="container">
                <!-- Back Navigation & Header -->
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <a href="/user" class="btn btn-outline-secondary text-light btn-sm">
                        <i class="fa-solid fa-arrow-left me-2"></i> Back to Dashboard
                    </a>
                    <div class="d-flex gap-2">
                        <?php

                        $myPlayingCol = array_filter($players, fn($p)=>($p['player_user_id']===$me['id']) );

                        $gameStatus = CustomFunctions::gameStatus($game['status']);
                        $status = '';
                        if ((($game['status'] == 'completed') || ($game['status'] == 'overriden_by_admin')) && ($myPlayingCol[0]['is_winner'])) {
                            $status = 'won';
                        }
                        if ((($game['status'] == 'completed') || ($game['status'] == 'overriden_by_admin')) && (!$myPlayingCol[0]['is_winner'])) {
                            $status = 'lost';
                        }
                        if (($game['status'] == 'pending') || ($game['status'] == 'in_progress') || ($game['status'] == 'disputed')) {
                            $status = 'pending';
                        }
                        $winStatus = CustomFunctions::winStatus($status);
                        ?>
                        <span class="badge <?= $winStatus['color'] ?>  fs-6 px-3 py-2 fw-bold d-flex align-items-center">
                            <i class="fa-solid <?= $winStatus['icon'] ?> me-2"></i><?= $winStatus['text'] ?>
                        </span>
                        <span class="badge <?= $gameStatus['bg-color'] ?> text-dark fs-6 px-3 py-2 fw-bold d-flex align-items-center">
                            <i class="fa-solid <?= $gameStatus['icon'] ?> me-2"></i><?= $gameStatus['text'] ?>
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
                                        <h2 class="text-white fw-bold mt-1 mb-2"><?= ($game['title']) ?></h2>
                                        <p class="text-muted mb-0" style="height: 75px; overflow:auto">
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
                        <div class="card box-border-linear-gradient bg-dark text-light border-0 rounded-4 shadow-lg mb-4" id="choices">
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
                                        $selectableChoices = [];
                                        foreach ($choices as $index => $choice) {
                                            $IvePlayed = array_filter($players, fn($r) => ($r['player_user_id'] ?? '') === $me['id']);
                                            $mychoice = ($IvePlayed[0]['answer_chosen'] ?? 0) === $choice['id'] ? 'checked' : ''; //checked means I've played
                                            $selectableChoices[$choice['id']] = $choice['choice_details'];

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

                                        <!-- Choice Option 2 --><!--
                            <label class="list-group-item bg-secondary bg-opacity-15 border-secondary rounded-3 text-light p-3 d-flex align-items-center justify-content-between cursor-pointer">
                                <div class="d-flex align-items-center gap-3">
                                    <input class="form-check-input bg-dark border-secondary" type="radio" name="answer_chosen" id="choice2" value="102">
                                    <div>
                                        <h6 class="text-white fw-bold mb-0">Choice #2: Celtics Win</h6>
                                        <span class="text-muted small">Awaiting Opponent selection</span>
                                    </div>
                                </div>
                                <span class="badge bg-dark border border-secondary text-muted px-3 py-2">Open Choice</span>
                            </label>-->

                                        <?php if (empty($mychoice)) { ?>
                                            <div class="mt-3 feedback "></div>
                                            <div class=" d-flex justify-content-end">
                                                <button class="btn btn-xsm btn-success" type="submit" style="border-color: var(--secondary-color);">Save your Choice</button>
                                            </div>
                                        <?php } ?>
                                    </form>


                                </div>

                                <div class="mt-4 p-3 bg-dark border border-secondary rounded-3 d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-2 text-muted small">
                                        <i class="fa-solid fa-shield-halved text-warning fs-5"></i>
                                        <span>Publicly Provable: <strong><?= $game['can_be_publicly_proven'] ? 'Yes' : 'No'  ?></strong></span>
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

                                
                                    <div class="d-flex justify-content-between gap-2 mt-3"> 
                                        <?php if (Session::get('role')==='Admin') { if ( ($game['status'] === 'completed')||($game['status'] === 'disputed')||($game['status'] === 'pending') || ($game['status'] === 'in_progress')  ) { ?>
                                        
                                        <a href="#" class="btn btn-outline-success" onclick="actOnMatch(`<?= $game['game_url'] ?>`, `<?= $game['title'] ?>`, 'override',`<?= htmlspecialchars(json_encode($selectableChoices)) ?>`);return false;">Override Results</a>

                                        <?php }} if (($game['status'] === 'completed')  ) { ?>
                                        <a href="#" class="btn btn-outline-danger" onclick="actOnMatch(`<?= $game['game_url'] ?>`, `<?= $game['title'] ?>`, 'disputed');return false;">Dispute Results</a>
                                        <?php } if ($game['created_by'] === $me['id']) { ?>
                                            
                                        <?php if (($game['status'] === 'in_progress') || ($game['status']==='pending') ) { ?>
                                            <a href="#" class="btn btn-outline-warning" onclick="actOnMatch(`<?= $game['game_url'] ?>`, `<?= $game['title'] ?>`, 'in_progress');return false;"
                                            ><?= ($game['status']=='in_progress') ?'Allow Others to Join' :'Progressing?' ?></a>
                                          
                                            <a href="#" class="btn btn-danger" onclick="actOnMatch(`<?= $game['game_url'] ?>`, `<?= $game['title'] ?>`, 'cancel' );return false;">Cancel</a>
                                             
                                            <a href="#" class="btn btn-outline-success" onclick="actOnMatch(`<?= $game['game_url'] ?>`, `<?= $game['title'] ?>`, 'completed',`<?= htmlspecialchars(json_encode($selectableChoices)) ?>`);return false;">Complete the Match</a>
                                        <?php } }?>
                                        <?php if (($game['status'] === 'completed') && ($game['created_by'] !== $me['id']) ) { ?>
                                        
                                            <a href="#" class="btn btn-outline-success" onclick="actOnMatch(`<?= $game['game_url'] ?>`, `<?= $game['title'] ?>`, 'vote',`<?= htmlspecialchars(json_encode($selectableChoices)) ?>`);return false;">Which option do you think won?</a>
                                        <?php } ?>
                                    </div>
                                    <div class="mt-3 alert shadow">
                                        <p>When a match is completed and it's solution could not be determined publicly:
                                            <ul>
                                                <li>A sole player will be assumed winner.</li> 
                                                <li>A simple majority of votes will win.</li>
                                                <li>Stake refund if noone selected the winning option </li>
                                            </ul>
                                            <a href="/legal/terms-of-use">Read more</a>
                                        </p>
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
                                        <?php $gameUrl = "https://{$_SERVER['SERVER_NAME']}/games/{$game['game_url']}?invite={$me['username']}"; ?>
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
                                    <?php foreach ($players as $player) {
                                        $username = CustomFunctions::maskString($player['username'] ?? '', 3);
                                        $status = CustomFunctions::playerStatus($player['player_accepted_invitation']);
                                    ?>
                                        <div class="d-flex align-items-center justify-content-between p-3 bg-secondary bg-opacity-15 rounded-3 border border-secondary">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="position-relative">
                                                    <div class="bg-warning text-dark fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                                        <?= $player['player_accepted_invitation'] == 'pending' ? '<i class="fa-solid fa-user-clock fs-5"></i>' : ($me['id'] === $player['player_user_id'] ? 'You' : substr($username, 0, 1)) ?>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="text-white fw-bold mb-0" title="<?= $player['username'] ?? '' ?>">
                                                        <?php $you = $me['id'] === $player['player_user_id'] ? 'You' : $username; ?>
                                                        <?= $game['created_by'] === $player['player_user_id'] ? "Host ($you)" : ($username) ?>
                                                    </h6>

                                                    <?= (!empty($player['choice_details'])) ?
                                                        "<span class='text-warning small'><i class='fa-solid fa-circle-check me-1'></i>
                                                    Choice: {$player['choice_details']} </span>"
                                                        : '<span class="text-muted small">Invitation Pending...</span>' ?>

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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            const formElement = document.querySelector('#saveChoice');
            const submitBtn = formElement.querySelector('button[type="submit"]');
            const feedback = document.querySelector('.feedback');

            formElement.addEventListener('submit', async (e) => {
                e.preventDefault();
                const form = new FormData(formElement);
                feedback.innerHTML = '';
                feedback.classList.remove('alert', 'alert-danger', 'alert-success');
                submitBtn.disabled = true;
                submitBtn.innerHTML = `<div class="spinner-border"role="status"><span class="visually-hidden">Loading...</span></div>`;

                try {

                    const confirm = await confirmChoice();
                    if (!confirm) return;

                    const response = await fetch('/myapp/requests', {
                        method: "POST",
                        body: form
                    });
                    const result = await response.json();
                    if ((!response.ok) || (result.error)) {
                        throw new Error(result.msg || "Something went wrong please try again");
                    }
                    //success
                    await Swal.fire({
                        title: `${result.msg || 'Success'}`,
                        icon: "success"
                    });
                    window.location.reload();

                } catch (er) {
                    console.log(er);
                    showToast(er);
                    feedback.classList.add('alert', 'alert-danger');
                    feedback.innerHTML = er;
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = "Save your Choice";
                }

            });

            const choicesradio = document.querySelectorAll('.choicesradio');
            async function confirmChoice() {
                let choiceNamed = '';
                choicesradio.forEach((el) => {
                    if (el.checked) {
                        choiceNamed = el.getAttribute('rel');
                    }
                });

                if (choiceNamed.length === 0) {
                    feedback.classList.add('alert', 'alert-danger');
                    showToast("Please pick a choice to proceed.");
                    feedback.innerHTML = "Please pick a choice to proceed.";
                    return;
                }

                const result = await Swal.fire({
                    title: "Are you sure?",
                    text: `'${choiceNamed}' will be your choice and you won't be able to change it!`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, I Confirm!",
                    allowOutsideClick: false
                });

                return result.isConfirmed;
            }

            const directInviteForm = document.querySelector('#directInviteForm');
            const inviteSubmitBtn = directInviteForm.querySelector('button[type="submit"]');
            const inviteBtnContent = inviteSubmitBtn.innerHTML;
            const inviteFeedback = document.querySelector('.inviteFeedback');

            directInviteForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                inviteFeedback.textContent = '';
                inviteFeedback.classList.remove('text-success', 'text-danger');
                inviteSubmitBtn.disabled = true;
                inviteSubmitBtn.innerHTML = `<div class="spinner-border"role="status"><span class="visually-hidden">Loading...</span></div>`;
                const form = new FormData(directInviteForm);
                const username = document.querySelector('input[name="username"]');

                try {
                    const response = await fetch('/myapp/requests', {
                        method: "POST",
                        body: form
                    });
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

            let actionTobeTaken = '';
            let moreText = '';
            let adminOverride = '';
            async function actOnMatch(game_url, title, status, options = '' ) {
                
                actionTobeTaken = status;
                const form = new FormData();
                form.set('game_url', game_url);
                form.set('status', status);
                let validOptions;
                let confirm;
                let winnerOption;
                switch (status) {
                    case 'override':
                        adminOverride = "The answer you choose will override any other supposed win and settle any dispute.";
                        validOptions = JSON.parse(options);
                        console.log(validOptions);
                        winnerOption = await selectWinnerOption(validOptions, title);
                        form.set('winner_id', winnerOption);
                        if (winnerOption)
                            sendAction(form);
                        break;
                    case 'vote':
                        adminOverride = '';
                        validOptions = JSON.parse(options);
                        console.log(validOptions);
                        winnerOption = await selectWinnerOption(validOptions, title);
                        form.set('winner_id', winnerOption);
                        if (winnerOption)
                            sendAction(form);
                        break;
                    case 'completed': 
                        adminOverride = '';
                        validOptions = JSON.parse(options);
                        console.log(validOptions);
                        winnerOption = await selectWinnerOption(validOptions, title);
                        form.set('winner_id', winnerOption);
                        if (winnerOption)
                            sendAction(form);
                        break;
                    case 'cancel':
                        moreText = `be cancelled and you will be refunded 100%. <br>However, it will not be cancelled if there are more that one player to maintain platform's integrity according to our <a href='/legal/terms-of-use'>terms</a>.
                        <br> $<?= CANCELLATION_FEE_PC ?>% will be deducted as a cancellation fee.`;
                        confirm = await confirmDisputingOrProgress(title);
                        if (!confirm) return;
                        sendAction(form);
                        break;
                    case 'in_progress':
                        moreText = `continue as it is but <bold style="font-weight:bold;color:red">NOBODY</bold> will be able to join, even those invited.`;
                        confirm = await confirmDisputingOrProgress(title);
                        if (!confirm) return;
                        sendAction(form);
                        break;
                    case 'disputed':
                        moreText = `remain disputed until admins intervene to settle it! This might take time.`;
                        confirm = await confirmDisputingOrProgress(title);
                        if (!confirm) return;
                        sendAction(form);
                        break;

                    default:
                        showToast("Something went wrong from your side");
                        break;
                }
            }

            async function selectWinnerOption(validOptions, title) {
                const { value: winner } = await Swal.fire({
                    title: `Which option won in ${title}?`,
                    html:  `<span class='text-danger'>${adminOverride}</span>`,
                    input: "select",
                    inputOptions: validOptions,
                    inputPlaceholder: "Select the winning option",
                    showCancelButton: true,
                    inputValidator: (value) => {
                        return new Promise((resolve) => {
                            if (value.length > 0) resolve();
                            else resolve("You must select an option");
                        });
                    }
                });
                return winner;
            }
            async function sendAction(form) {
                form.set('csrf_token', '<?= CSRF::get() ?>');
                form.set('method', 'MatchStatusAction');

                try {
                    const response = await fetch('/myapp/requests', {
                        method: "POST",
                        body: form
                    });
                    const result = await response.json();
                    if ((!response.ok) || result.error) {
                        throw new Error(result.msg || "Something went wrong. Please try again.");
                    }

                    showToast(result.msg || `The game was successfully ${actionTobeTaken}.`, 'bg-success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);

                } catch (error) {
                    await Swal.fire({ 
                        text:error,
                        icon: "error", 
                    });
                    showToast(error);
                }

            }
            async function confirmDisputingOrProgress(title) {

                const result = await Swal.fire({
                    title: "Are you sure?",
                    html: `<bold style="font-weight:bold">${title}'s</bold> will ${moreText}`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, I Confirm!",
                    allowOutsideClick: false
                });

                return result.isConfirmed;
            }
        </script>

    </div>


    <!-- Contact Us Page End -->


    <?php require 'public/includes/footer.inc.php' ?>
</body>

</html>