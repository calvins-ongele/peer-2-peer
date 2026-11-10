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

    
    <div class="row">

                <div class="col-lg-3 col-12"></div>
                <div class="col-lg-6 col-12">
                    <!-- Contact Form Section Start -->
                    <div class="alert" data-wow-delay="0.50s">
                        <!-- Section Ttile start -->
                        <div class="section-title text-lg-start text-center"> 
                            <h2 class="wow fadeInUp" data-wow-delay="0.50s">Add funds</h2>
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

<script>
    const depositRequest = document.querySelector('#depo');
    const feedback = document.querySelector('.form-feedback');
    const submitBtn = depositRequest.querySelector('[type="submit"]');
    const btnContent = submitBtn.innerHTML; 

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

     
    
</script>


    <?php require 'public/includes/footer.inc.php' ?>
</body>
</html>