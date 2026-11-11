<?php
//  $choices = ['Doe', '', null, 'Nairobi'];
//  $filtered = array_filter($choices);
//  print_r(count($filtered));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'public/includes/header.inc.php' ?>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> 
    <style>
        .text-muted {
            color: rgba(255,255,255,0.6) !important;
            font-size: 11px !important;
        }
        .btn-warning, .bg-warning {
            background: linear-gradient(180deg, var(--secondary-color) 0%, var(--accent-color) 100%) !important;
            border: 1px solid  var(--accent-color) !important;
        }
        .text-warning {
            color: var(--accent-color) !important;
        }
        .btn-outline-warning {
            border: 1px solid  var(--accent-color) !important;
            color: var(--accent-color) !important;
        }
        .btn-outline-warning:hover {
            background: var(--accent-color) !important;
            color: white !important;
        }
        
        /* Qualified Popup Modal Styling */
        .congrats-modal-header {
            background: linear-gradient(135deg, var(--body-primary-background) 0%, var(--accent-color) 100%);
            color: white;
            border-radius: 1rem 1rem 0 0;
            padding: 2.5rem 1.5rem 1.5rem 1.5rem;
            text-align: center;
            position: relative;
        }

        .congrats-badge-icon {
            width: 70px;
            height: 70px;
            background: #ffffff;
            color: var(--body-primary-background);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            margin: 0 auto 1rem auto;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

    </style>
</head>

<body class="tt-magic-cursor">

    <!-- Preloader Start -->
    <?php require 'public/includes/navbar.inc.php' ?>
    <!-- main Header end -->

    <!-- Subpage Hero Section Start -->
     <!--
    <div class="subpage-header">
        <div class="container">
            <div class="row">
                <div class="co-md-12"> 
                    <div class="subpage-header-box">
                        <h1 class="wow fadeInUp" data-wow-delay="0.25s">Create a Wager Game</h1>
                        <ul class="breadcrumb wow fadeInUp" data-wow-delay="0.50s">
                            <li><a href="/">Home</a></li>
                            <li>Wager Game</li>
                        </ul>
                    </div> 
                </div>
            </div>
        </div>
    </div>-->
    <!-- Subpage Hero Section End -->

    <!-- Contact Us Page Start -->
    <div class="page-contact-us">
        <div class="container">

            <!-- Create Game Section Start -->
            <section class="create-game-section py-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10">
                            <div class="card box-border-linear-gradient border-0 shadow-lg bg-dark text-light rounded-4 overflow-hidden">

                                <?php if (Session::get('userid') == null){ ?>
                                   <div class="alert alert-sm alert-danger" >You need to login to proceed. <a href="/account?return=<?= urlencode($_SERVER['REQUEST_URI']) ?>">Login Now..</a></div>
                                <?php } else {  ?>

                                <!-- Card Header -->
                                <div class="card-header bg-transparent border-secondary text-center py-4">
                                    <h3 class="text-white mb-1 fw-bold">Create a Wager Game</h3>
                                    <p class="text-muted small mb-0">Set up your terms, choices, and stake cost in 4 simple steps.</p>
                                </div>

                                <!-- Step Progress Indicator -->
                                <div class="card-body px-lg-5 pt-4 pb-0">
                                    <div class="position-relative mb-5">
                                        <div class="progress bg-secondary" style="height: 3px;">
                                            <div class="progress-bar bg-warning" role="progressbar" id="stepProgressBar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="d-flex justify-content-between position-absolute top-50 start-0 end-0 translate-middle-y">
                                            <button type="button" class="btn btn-sm btn-warning rounded-circle step-indicator fw-bold" id="step-btn-1" style="width: 38px; height: 38px;">1</button>
                                            <button type="button" class="btn btn-sm btn-secondary text-white rounded-circle step-indicator fw-bold" id="step-btn-2" style="width: 38px; height: 38px;">2</button>
                                            <button type="button" class="btn btn-sm btn-secondary text-white rounded-circle step-indicator fw-bold" id="step-btn-3" style="width: 38px; height: 38px;">3</button>
                                            <button type="button" class="btn btn-sm btn-secondary text-white rounded-circle step-indicator fw-bold" id="step-btn-4" style="width: 38px; height: 38px;">4</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Multi-Step Form Start -->
                                <form id="createGameForm" class="card-body px-lg-5 pb-5">
                                    <input type="hidden" name="csrf_token" value="<?= CSRF::get() ?>" />
                                    <input type="hidden" name="method" value="CreateAGame" />

                                    <!-- STEP 1: Game Details -->
                                    <div class="form-step active-step" id="step-1">
                                        <h5 class="text-warning mb-3"><i class="fa-solid fa-gamepad me-2"></i>Step 1: Game Information</h5>

                                        <div class="mb-3">
                                            <label for="gameTitle" class="form-label text-light fw-medium">Game Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control bg-secondary text-white border-0 py-2" id="gameTitle" name="title" maxlength="150" placeholder="e.g., Lakers vs Warriors NBA Finals Game 1" required>
                                            <div class="form-text text-muted">A clear, concise title describing the wager.</div>
                                            <div class="invalid-feedback">Please enter a valid title.</div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="gameDescription" class="form-label text-light fw-medium">Description (Optional)</label>
                                            <textarea class="form-control bg-secondary text-white border-0 py-2" id="gameDescription" name="description" rows="3" placeholder="Provide extra details, rules, or specific conditions for this match..."></textarea>
                                        </div>

                                        <div class="d-flex justify-content-end mt-4">
                                            <button type="button" class="btn btn-warning px-4 fw-bold next-step-btn" data-next="2">
                                                Next: Define Choices <i class="fa-solid fa-arrow-right ms-2"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- STEP 2: Outcome Choices -->
                                    <div class="form-step d-none" id="step-2">
                                        <h5 class="text-warning mb-3"><i class="fa-solid fa-list-check me-2"></i>Step 2: Outcome Choices</h5>
                                        <p class="text-muted small">Add the possible choices participants can pick from. (Minimum 2 required)</p>

                                        <div id="choicesContainer">
                                            <div class="mb-3 choice-input-group">
                                                <label class="form-label text-light fw-medium">Choice 1 <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-dark text-warning border-secondary"><i class="fa-solid fa-check"></i></span>
                                                    <input type="text" class="form-control bg-secondary text-white border-0 py-2" name="choices[]" placeholder="e.g., Lakers Win" required>
                                                    <div class="invalid-feedback">Please enter a valid choice.</div>
                                                </div>
                                            </div>
                                            <div class="mb-3 choice-input-group">
                                                <label class="form-label text-light fw-medium">Choice 2 <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-dark text-warning border-secondary"><i class="fa-solid fa-check"></i></span>
                                                    <input type="text" class="form-control bg-secondary text-white border-0 py-2" name="choices[]" placeholder="e.g., Warriors Win" required>
                                                    <div class="invalid-feedback">Please enter a valid choice.</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <button type="button" class="btn btn-outline-warning btn-sm" id="addChoiceBtn">
                                                <i class="fa-solid fa-plus me-1"></i> Add Another Choice
                                            </button>
                                        </div>

                                        <div class="d-flex justify-content-between mt-4">
                                            <button type="button" class="btn btn-outline-secondary text-light px-4 prev-step-btn" data-prev="1">
                                                <i class="fa-solid fa-arrow-left me-2"></i> Back
                                            </button>
                                            <button type="button" class="btn btn-warning px-4 fw-bold next-step-btn" data-next="3">
                                                Next: Stakes & Rules <i class="fa-solid fa-arrow-right ms-2"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- STEP 3: Game Type, Stakes & Proof Rules -->
                                    <div class="form-step d-none" id="step-3">
                                        <h5 class="text-warning mb-3"><i class="fa-solid fa-sliders me-2"></i>Step 3: Stakes & Game Rules</h5>

                                        <div class="row g-3 mb-3">
                                            <div class="col-md-6">
                                                <label for="gameType" class="form-label text-light fw-medium">Game Type</label>
                                                <select class="form-select bg-secondary text-white border-0 py-2" id="gameType" name="game_type" required >
                                                    <option value=""  hidden style="color:white">Select game type</option>
                                                    <option value="public">Public (Open via Link / Listing)</option>
                                                    <option value="private" >Private (1-on-1 Invited Opponent)</option>
                                                </select>
                                                <div class="invalid-feedback">Please enter a valid type.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="stakeCost" class="form-label text-light fw-medium">Stake Cost (USD)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-dark text-warning border-secondary">$</span>
                                                    <input required type="number" class="form-control bg-secondary text-white border-0 py-2" id="stakeCost" name="stake_cost" step="0.01" min="0.00" value="" placeholder="0.00">
                                                <div class="invalid-feedback">Please enter a valid cost.</div>
                                                </div>
                                                <div class="form-text text-muted freeforPromotion">Set to <code>0.00</code> for free promotional matches.</div>
                                            </div>
                                        </div>

                                        <div class="card bg-secondary bg-opacity-25 border-secondary p-3 mb-3">
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" role="switch" id="publiclyProven" name="can_be_publicly_proven" value="1">
                                                <label class="form-check-label text-light fw-medium" for="publiclyProven">
                                                    Publicly Provable Outcome 
                                                </label>
                                                <div class="form-text text-muted small">Enable if the outcome can be verified via official sports feeds, public APIs, or published records.</div>
                                            </div>

                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input" type="checkbox" role="switch" id="doubleOrNothing" name="is_double_or_nothing" value="1">
                                                <label class="form-check-label text-light fw-medium" for="doubleOrNothing">
                                                    Enable Double or Nothing 
                                                </label>
                                                <div class="form-text text-muted small">Allows doubling stakes in the event of a tie, dispute, or mutually agreed rematch.</div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="evidenceUrl" class="form-label text-light fw-medium">Evidence / Proof Reference URL (Optional)</label>
                                            <input type="text" class="form-control bg-secondary text-white border-0 py-2" id="evidenceUrl" name="evidence_4_disputes" maxlength="500"
                                             placeholder="Explain or provide a URL" mplaceholder="https://official-stats.com/match/12345">
                                            <div class="form-text text-muted">Default link or stream URL to assist in settling potential disputes.</div>
                                        </div>

                                        <div class="d-flex justify-content-between mt-4">
                                            <button type="button" class="btn btn-outline-secondary text-light px-4 prev-step-btn" data-prev="2">
                                                <i class="fa-solid fa-arrow-left me-2"></i> Back
                                            </button>
                                            <button type="button" class="btn btn-warning px-4 fw-bold next-step-btn" data-next="4">
                                                Next: Review & Launch <i class="fa-solid fa-arrow-right ms-2"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- STEP 4: Summary & Confirmation -->
                                    <div class="form-step d-none" id="step-4">
                                        <h5 class="text-warning mb-3"><i class="fa-solid fa-shield-halved me-2"></i>Step 4: Review & Confirm</h5>

                                        <div class="card bg-secondary bg-opacity-25 border-secondary p-3 mb-4">
                                            <h6 class="text-warning fw-bold border-bottom border-secondary pb-2 mb-3" id="summaryTitle">Game Title</h6>
                                            <p class="text-light small mb-2" id="summaryDescription">No description provided.</p>

                                            <div class="row g-2 my-2">
                                                <div class="col-6">
                                                    <span class="text-muted small">Game Type:</span>
                                                    <span class="badge bg-primary d-block mt-1" id="summaryType">Private</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted small">Stake Cost:</span>
                                                    <span class="badge bg-success d-block mt-1" id="summaryStake">$0.00</span>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <span class="text-muted small d-block mb-1">Defined Choices:</span>
                                                <ul class="list-group list-group-flush rounded" id="summaryChoicesList">
                                                    <!-- Dynamically populated via JS -->
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" id="termsCheck" required>
                                            <label class="form-check-label text-light small" for="termsCheck">
                                                I agree to the <a href="/legal/terms-of-use" class="text-warning text-decoration-none">Terms of Use</a> and acknowledge that stakes are committed to automated escrow upon match initiation.
                                            </label>
                                        </div>
                                        <div class="feedback"></div>

                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-outline-secondary text-light px-4 prev-step-btn" data-prev="3">
                                                <i class="fa-solid fa-arrow-left me-2"></i> Back
                                            </button>
                                            <button type="submit" class="btn btn-warning px-5 fw-bold text-dark" id="submitGameBtn">
                                                <i class="fa-solid fa-rocket me-2"></i> Launch Game
                                            </button>
                                        </div>
                                    </div>

                                </form>
                                <!-- Multi-Step Form End -->
                                 <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Create Game Section End -->

        </div>
    </div>

       <!-- COLORFUL CONGRATULATIONS RESULT MODAL -->
        <div class="modal fade" id="congratsModal" tabindex="-1"  data-bs-backdrop="static" data-bs-keyboard="false"  aria-hidden="true">
    
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg overflow-hidden" style="border-radius: 1rem;">
                <div class="congrats-modal-header">
                    <div class="congrats-badge-icon">
                        <i class="bi bi-award-fill"></i>
                    </div>
                    <h3 class="fw-extrabold mb-1">Congratulations! 🎉</h3>
                    <p class="mb-0 opacity-90 small">You have successfully created a wager game</p>
                </div>
                <div class="modal-body text-center p-4">
                    <span class="text-uppercase fw-bold text-muted small">Wager Amount</span>
                    <h1 class="display-5 fw-extrabold text-success my-2" id="qualifiedAmountDisplay">$0.00</h1>
                    <p class="text-muted small mb-4" style="color:var(--body-primary-background) !important;">Anyone joining will have to pay the amount.</p>

                    <a href="/index/convenience" class="proceedToInvite btn btn-action w-100 justify-content-center py-3 fs-6" style="background:var(--body-primary-background);color:white" >
                        Proceed to Invite Players <i class="bi bi-arrow-right-circle-fill"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Us Page End -->
    <!-- Lightweight Multi-Step Form Controller Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentStep = 1;
            let choiceCount = 2;

            const totalSteps = 4;
            const progressBar = document.getElementById('stepProgressBar');
            const addChoiceBtn = document.getElementById('addChoiceBtn');
            const choicesContainer = document.getElementById('choicesContainer'); 
            const congratsModal = new bootstrap.Modal(document.getElementById('congratsModal'));
            const balance = parseFloat(`<?= $this->_me['user_balance']??0 ?>`);         

            // Handle Next Step
            document.querySelectorAll('.next-step-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const nextStep = parseInt(this.getAttribute('data-next'));
                    if (validateStep(currentStep)) {
                        if (nextStep === 4) populateSummary();
                        goToStep(nextStep);
                    }
                });
            });

            // Handle Previous Step
            document.querySelectorAll('.prev-step-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const prevStep = parseInt(this.getAttribute('data-prev'));
                    goToStep(prevStep);
                });
            });

            // Add Dynamic Outcome Choices
            addChoiceBtn.addEventListener('click', function() {
                choiceCount++;
                const choiceDiv = document.createElement('div');
                choiceDiv.className = 'mb-3 choice-input-group';
                choiceDiv.innerHTML = `
            <label class="form-label text-light fw-medium">Choice ${choiceCount} <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text bg-dark text-warning border-secondary"><i class="fa-solid fa-check"></i></span>
                <input required type="text" class="form-control bg-secondary text-white border-0 py-2" name="choices[]" placeholder="e.g., Draw / Rematch" required>
                <button type="button" class="btn btn-outline-danger remove-choice-btn"><i class="fa-solid fa-trash"></i></button>
                <div class="invalid-feedback">Please enter a choice.</div>
            </div>
        `;
                choicesContainer.appendChild(choiceDiv);

                choiceDiv.querySelector('.remove-choice-btn').addEventListener('click', function() {
                    choiceDiv.remove();
                });
            });

            // Step Switcher Logic
            function goToStep(step) {
                document.querySelectorAll('.form-step').forEach(el => el.classList.add('d-none'));
                document.getElementById(`step-${step}`).classList.remove('d-none');

                // Update indicators
                for (let i = 1; i <= totalSteps; i++) {
                    const btn = document.getElementById(`step-btn-${i}`);
                    if (i <= step) {
                        btn.classList.remove('btn-secondary', 'text-white');
                        btn.classList.add('btn-warning', 'text-dark');
                    } else {
                        btn.classList.remove('btn-warning', 'text-dark');
                        btn.classList.add('btn-secondary', 'text-white');
                    }
                }

                // Update progress bar width
                const progressPercentage = (step / totalSteps) * 100;
                progressBar.style.width = `${progressPercentage}%`;
                progressBar.setAttribute('aria-valuenow', progressPercentage);

                currentStep = step;
            }

            // Basic Validation
            function validateStep(step) {
                const stepContainer = document.getElementById(`step-${step}`);
                const inputs = stepContainer.querySelectorAll('input[required], select[required]');
                let valid = true;

                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        input.classList.add('is-invalid');
                        valid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });

                return valid;
            }

            // Populate Summary Card in Step 4
            function populateSummary() {
                document.getElementById('summaryTitle').textContent = document.getElementById('gameTitle').value || 'Untitled Game';
                const substr = document.getElementById('gameDescription').value || 'No description provided.'; 
                document.getElementById('summaryDescription').textContent = `${substr.slice(0, 30)}...`;

                const typeSelect = document.getElementById('gameType');
                document.getElementById('summaryType').textContent = typeSelect.options[typeSelect.selectedIndex].text;

                const stakeVal = parseFloat(document.getElementById('stakeCost').value || 0).toFixed(2);
                document.getElementById('summaryStake').textContent = `$${stakeVal} USD`;

                const summaryChoicesList = document.getElementById('summaryChoicesList');
                summaryChoicesList.innerHTML = '';

                const choiceInputs = document.querySelectorAll('input[name="choices[]"]');
                choiceInputs.forEach((input, idx) => {
                    if (input.value.trim()) {
                        const li = document.createElement('li');
                        li.className = 'list-group-item bg-dark text-white border-secondary small d-flex justify-content-between align-items-center';
                        li.innerHTML = `<span>Choice ${idx + 1}: ${input.value}</span> <i class="fa-solid fa-circle-check text-warning"></i>`;
                        summaryChoicesList.appendChild(li);
                    }
                });
            }
            //
            const createGameForm = document.querySelector('#createGameForm');
            const submitGameBtn = document.querySelector('#submitGameBtn');
            const submitBtnContent = submitGameBtn.innerHTML;
            const feedback = document.querySelector('.feedback');
            let url = '';
 
            createGameForm.addEventListener('submit', async (e)=> {
                e.preventDefault();
                submitGameBtn.disabled = true;
                submitGameBtn.innerHTML = `<div class="spinner-border"role="status"><span class="visually-hidden">Loading...</span></div>`;
                feedback.classList.remove('alert', 'alert-danger', 'alert-success', 'wow', 'fadeInUp');
                feedback.innerHTML = '';
                url = '';

                try {
                    const response = await fetch('/myapp/requests', {body:new FormData(createGameForm), method:"POST"});
                    const result = await response.json();

                    if ( (!response.ok) || (result.error) ) {
                        url = result.cl || '';
                        throw new Error(result.msg || "Something went wrong please try again");
                    }

                    feedback.innerHTML = result.msg;
                    feedback.classList.add('alert', 'alert-success', 'wow', 'fadeInUp');
                    document.querySelector('#qualifiedAmountDisplay').textContent = `$${document.querySelector('#stakeCost').value || 0.00}`;
                    congratsModal.show(); 
                    document.querySelector('.proceedToInvite').setAttribute('href', result.cl||'#');
                    
                } catch (error) {
                    showToast(error);
                    feedback.innerHTML = error;
                    feedback.classList.add('alert', 'alert-danger', 'wow', 'fadeInUp');
                    if (url.length > 0) {
                        setTimeout(()=>{ window.location.href=url }, 1500);
                    }

                } finally {
                    submitGameBtn.disabled = false;
                    submitGameBtn.innerHTML = submitBtnContent;
                }
            });

            const stakeCost = document.querySelector('input[name="stake_cost"]');
            const freeforPromotion = document.querySelector('.freeforPromotion');
            stakeCost.addEventListener('input', ()=> {
                const val = parseFloat(`${stakeCost.value || 0}`);
                freeforPromotion.innerHTML = '';
                if (val > balance)  {
                    freeforPromotion.classList.remove('text-muted');
                    freeforPromotion.classList.add('text-danger');
                    freeforPromotion.innerHTML = `Insufficient balance. <a href='/user/balance' target='_blank'>Deposit $${val-balance} more.</a>`;
                } else {
                    freeforPromotion.classList.add('text-muted');
                    freeforPromotion.classList.remove('text-danger');
                }
            })




            //loaded
        });
    </script>
    <?php require 'public/includes/footer.inc.php' ?>
</body>

</html>