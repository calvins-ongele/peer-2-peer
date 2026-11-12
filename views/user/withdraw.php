<?php
    $url = 'abc d efg h iks';
    $url = (!empty($url)) ? CustomFunctions::validUrl($url) : CustomFunctions::randchars(30);
    //echo $url;
?>
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
        input::placeholder {
            font-style: italic;
            font-size: 11px;
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
                        <div class="section-title-custom d text-lg-start text-center d-flex justify-content-between"> 
                            <h2 class="wow fadeInUp" data-wow-delay="0.50s">Instantly withdraw funds</h2>
 
                        </div>
                         <div class="wow fadeInUp" >
                            <p class="text-danger " style="font-size:10px">NOTE: We will take no responsibility if money is lost as a result of incorrect payment details.</p>
                         </div>
                        <!-- Section Title end -->

                        <!-- Contact Form start -->
                        <section class="mt-4 contact-form wow fadeInUp" data-wow-delay="0.75s">
 
                         <form id="depo">
                            <input type="hidden" name="csrf_token" value="<?= CSRF::get() ?>" ?>
                            <input type="hidden" name="method" value="withdrawalRequest" ?>


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
                             <div class="mt-3 d-none relevantFields" rel="crypto">
                                 <label class="block text-sm font-medium mb-2">Wallet Address </label>
                                 <input placeholder="eg 0x71C7656EC7ab88b098defB751B7401B5f6d8976F" type="address" name="address" required="required" class="form-control" > <!---->
                             </div>
                             <div class="mt-3 d-none relevantFields" rel="crypto"> <!---TODO -- add selectable networks available ---->
                                 <label class="block text-sm font-medium mb-2">Network </label>
                                 <input placeholder="eg ERC-20" type="text" name="network" required="required" class="form-control" > <!---->
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
                    <p class="mb-0 opacity-90 small">You have successfully transacted</p>
                </div>
                <div class="modal-body text-center p-4">
                    <span class="text-uppercase fw-bold text-muted small">Wager Amount</span>
                    <h1 class="display-5 fw-extrabold text-success my-2" id="qualifiedAmountDisplay">$0.00</h1>
                    <p class="text-muted small mb-4 text-feedback" 
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

    
    let congratsModal;
    document.addEventListener('DOMContentLoaded', function() { 
      congratsModal = new bootstrap.Modal(document.getElementById('congratsModal')); 

    });

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
            const amount = document.querySelector('input[name="amount"]').value ?? 0;

             paymentSuccess({
                error:false,
                msg:result.msg||"Success",
                amount_usd: amount,
                amount_kes:500,
                actually_paid_usd: amount
            });
           
            
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
        const methodType = type.split(':')[0] ?? '';
        const fields = document.querySelectorAll('.relevantFields');
        fields.forEach((element)=> {
            const rel = element.getAttribute('rel');

            if (rel === methodType) {
                element.classList.remove('d-none');
                element.querySelector('input').required = true;
            } else {
                element.classList.add('d-none');
                element.querySelector('input').required = false;
            }
        });
    }
    
  
    function paymentSuccess(data) { 
 
        const origialAmount = parseFloat(data.amount_usd || '0.00');
  
        document.querySelector('#qualifiedAmountDisplay').textContent = `$${origialAmount}`;
        document.querySelector('.text-feedback').innerHTML = data.msg || "Your payment was successfully initiated."

        congratsModal.show();
    }


    
    

     
    
</script>


    <?php require 'public/includes/footer.inc.php' ?>
</body>
</html>