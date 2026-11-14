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
 
                        </div>
                        <!-- Section Title end -->

                        <!-- Contact Form start -->
                        <section class="contact-form wow fadeInUp" data-wow-delay="0.75s">
 
                            <section class='container'>
                                    <?= $this->deposit ?>
                            </section> 
                           
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
    
    setInterval(() => {

        const orderid = document.getElementById('orderid')?.textContent;
        if (!orderid) return;
        const form  = new FormData();
        form.set('csrf_token', '<?= CSRF::get() ?>');
        form.set('order_id', orderid);
        form.set('method', 'paymentStatus');
 

        fetch('/myapp/requests', {
        method: 'POST', 
        body: form
        })
        .then(res => res.json())
        .then(result => {
            
        if (result.error == false) {
            showErrorToast(result.msg || 'Action done successfully', true);
            setTimeout(() => {
                if (result.cl !== "") window.location.href = result.cl;
            }, 1500);
        } else {
           // showErrorToast(result.msg || 'Failed to handle your request');
        }

 
        })
        .catch(err => console.error(err));
        

        
        
    }, 10000);

    
</script>
    <?php require 'public/includes/footer.inc.php' ?>
</body>
</html>