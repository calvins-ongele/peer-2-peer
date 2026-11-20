<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'public/includes/header.inc.php' ?>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> 
    <style>
        .text-muted {
            color:whitesmoke !important;

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
     <?php require 'public/includes/profile.nav.php' ?>
    <!-- main Header end -->

     

    <!-- Contact Us Page Start -->
    <div class="container">

    
    <div class="row">

                <div class="col-lg-3 col-12"></div>
                <div class="col-lg-6 col-12">
                    
                    <!-- Contact Form Section Start -->
                    <div class="alert" data-wow-delay="0.50s" id="mainBody">
                         
                        <!-- Section Ttile start -->
                        <div class="section-title text-lg-start text-center d-flex justify-content-between"> 
                            <h2 class="wow fadeInUp" data-wow-delay="0.50s">Add funds</h2>

                             <div class="wow fadeInUp">
                                <a href="/user/balance/withdraw" class="btn btn-primary " >Withdraw Funds</a>
                            </div>
                        </div>
                        <!-- Section Title end -->

                        <!-- Contact Form start -->
                        <section class="contact-form wow fadeInUp" data-wow-delay="0.75s">
 
                         <form id="depo">
                            <input type="hidden" name="csrf_token" value="<?= CSRF::get() ?>" ?>
                            <input type="hidden" name="method" value="depositRequest" ?>


                             <div>
                                 <label class="block text-sm font-medium mb-2">Amount to deposit (in <?= $this->_settings['default_currency'] ?>)</label>
                                 <input placeholder="0.00" type="text" name="amount" required="required" class="form-control" > <!---->
                             </div>

                             <div class="mt-4">
                                 <label class="block text-sm font-medium mb-2">Select payment method</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="coin" id="radioDefault1" value="paypal" required>
                                    <label class="form-check-label" for="radioDefault1">
                                        Paypal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="coin" id="radioDefault1a" value="mpesa" required>
                                    <label class="form-check-label" for="radioDefault1a">
                                        Mpesa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="coin" id="radioDefault1y" value="crypto:USDT" required>
                                    <label class="form-check-label" for="radioDefault1y">
                                        USDT
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="coin" id="radioDefault1x" value="crypto:LTC" required>
                                    <label class="form-check-label" for="radioDefault1x">
                                        Litecoin
                                    </label>
                                </div>
                                     
                             </div> 
                             
                             <div class="mt-3 d-none relevantFields" rel="mpesa">
                                 <label class="block text-sm font-medium mb-2">Phone Number </label>
                                 <input placeholder="07xxxxx" type="tel" name="phone" required="required" class="form-control" > <!---->
                             </div>
                             <div class="mt-3 d-none relevantFields" rel="paypal">
                                 <label class="block text-sm font-medium mb-2">Paypal Email </label>
                                 <input placeholder="example@email.com" type="email" name="email" required="required" class="form-control" > <!---->
                             </div>


                              

                             <div class="form-components__block mt-3 d-flex justify-content-end">
                                 <div class="form-components__block-item block-button">
                                     <button type="submit" id="continueBtn" class="btn btn-danger d-block text-center">Continue</button>
                                 </div>
                             </div>

                             <div class="form-feedback mt-2"></div>



                         </form>
 
                          
                           
                        </section>
                        <!-- Contact Form end -->
                    </div>
                    <!-- Contact Form Section End -->
                </div>

                


            </div> 

        
     
    </div> 
 

    <!-- Contact Us Page End -->

    

       <!-- COLORFUL CONGRATULATIONS RESULT MODAL -->
        <div class="modal fade" id="congratsModal" tabindex="-1"  data-bs-backdrop="static" data-bs-keyboard="false"  aria-hidden="true">
    
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg overflow-hidden" style="border-radius: 1rem;">
                <div class="congrats-modal-header">
                    <div class="congrats-badge-icon">
                        <i class="bi bi-award-fill"></i>
                    </div>
                    <h3 class="fw-extrabold mb-1">Congratulations! 🎉</h3>
                    <p class="mb-0 opacity-90 small">You have successfully deposited money</p>
                </div>
                <div class="modal-body text-center p-4">
                    <span class="text-uppercase fw-bold text-muted small">Wager Amount</span>
                    <h1 class="display-5 fw-extrabold text-success my-2" id="qualifiedAmountDisplay">$0.00</h1>
                    <p class="text-muted small mb-4" 
                        style="color:var(--body-primary-background) !important;">You can proceed to play.</p>

                    <a href="/user/balance" class="qualifiedAmountHref btn btn-action w-100 justify-content-center py-3 fs-6"
                     style="background:var(--body-primary-background);color:white" >
                        Superb<i class="bi bi-arrow-right-circle-fill"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

<script>
    const depositRequest = document.querySelector('#depo');
    const feedback = document.querySelector('.form-feedback');
    const submitBtn = depositRequest.querySelector('[type="submit"]');
    const btnContent = submitBtn.innerHTML; 
    const feedbackBody = document.querySelector('#mainBody');

    depositRequest.addEventListener('submit', async (e)=> {
        e.preventDefault();
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Loading...';
        feedback.innerHTML = '';

        try {
            const form = new FormData(depositRequest);
            const req = await fetch('/myapp/requests', {method:"POST", body:form});
            const result = await req.json();
            feedback.classList.remove('alert', 'alert-success', 'alert-danger');

            if ((!req.ok) || result.error) {
                throw new Error(result.msg || "Something went wrong. Please try again.");
            }
            
            feedback.classList.add('alert', 'alert-success');
            feedback.innerHTML = result.msg||'Success'; 

            const pmethod = form.get('coin'); 

            if ( pmethod == 'mpesa' ) { 
                startPollingMpesaFeedback(result.ordernumber || '');
            } // no need
            if ( pmethod == 'paypal' ) {
                const initId = result.cl.split('=')[1] ?? '';
                if (initId.length > 0) startPollingPaypalFeedback(initId);
                return;
             } // no need

            //crypto
            
            const pm = pmethod.split(':')[0]??'';
            
            if ( pm === 'crypto' )
                if (result.cl.length > 0) {
                    location.href=`${result.cl}`;
                } 
            
        } catch(er) { 
            console.log(er);
            feedback.classList.add('alert', 'alert-danger');
            feedback.innerHTML = er; 
        }
        finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = btnContent;
        }
        
    });
    const methodSelected = document.querySelectorAll('input[name="coin"]');
    methodSelected.forEach((el)=> {
        el.addEventListener('change', ()=> {
            showRelevantFields(el.value);
        }); 
    });

    function showRelevantFields(type) {
        const fields = document.querySelectorAll('.relevantFields');
        fields.forEach((element)=> {
            const rel = element.getAttribute('rel');

            if (rel === type) {
                element.classList.remove('d-none');
                element.querySelector('input').required = true;
            } else {
                element.classList.add('d-none');
                element.querySelector('input').required = false;
            }
        });
    }
    
    async function startPollingPaypalFeedback(initId) {
        let pollingNeded = true;
        const form = new FormData();
        form.set('init_id', initId);
        form.set('csrf_token', `<?= CSRF::get() ?>`);
        form.set('method', `confirmPayplIsDone`);

        while (pollingNeded) {
            const response = await fetch('/myapp/requests', {method:"POST", body:form });
            const result = await response.json();
            if ( (!respon.ok) || (result.error)){}
            else {
                pollingNeded = false;
                paypalSuccess(result);
            }
 
        }

    }

    let congratsModal;
    document.addEventListener('DOMContentLoaded', function() { 
      congratsModal = new bootstrap.Modal(document.getElementById('congratsModal'));
      
        // paypalSuccess({
        //     error:false,
        //     msg:"Success",
        //     amount_usd: 3.5,
        //     amount_kes:500,
        //     actually_paid_usd: 3.5
        // });

    });

    function paypalSuccess(data) { 

        const actual = parseFloat(data.actually_paid_usd || '0.00');
        const origialAmount = parseFloat(data.amount_usd || '0.00');

        let amount = origialAmount > actual ? actual : origialAmount;  
        document.querySelector('#qualifiedAmountDisplay').textContent = `$${amount}`;

        congratsModal.show();
    }
    async function startPollingMpesaFeedback(orderId) {
        
        let pollingNeded = true;
        const form = new FormData();
        form.set('order_id', orderId);
        form.set('csrf_token', `<?= CSRF::get() ?>`);
        form.set('method', `confirmMpesaIsDone`);

        while (pollingNeded) {
            const response = await fetch('/myapp/requests', {method:"POST", body:form });
            const result = await response.json();
            if ( (!respon.ok) || (result.error)){}
            else {
                pollingNeded = false;
                const base = parseFloat(`<?= USD_2_KES_RATE ?>`);
                const amount = result.actually_paid_usd;
                paypalSuccess({
                    error:false,
                    msg:"Success",
                    amount_usd: result.actually_paid_usd / base,
                    amount_kes:result.actually_paid_usd / base,
                    actually_paid_usd: result.actually_paid_usd / base
                });
            }
 
        }
    }

     
    
</script>


    <?php require 'public/includes/footer.inc.php' ?>
</body>
</html>