<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'public/includes/header.inc.php' ?>
</head>
<body class="tt-magic-cursor">

    <!-- Preloader Start -->
     <?php require 'public/includes/navbar.inc.php' ?>
    <!-- main Header end -->

     

    <!-- Contact Us Page Start -->
    <div class="page-contact-us">
        
    <div class="container">
            <div class="row">

                <div class="col-lg-3 col-12"></div>
                <div class="col-lg-6 col-12">
                    <!-- Contact Form Section Start -->
                    <div class="contact-form-box box-border-linear-gradient wow fadeInUp" data-wow-delay="0.50s">
                        <!-- Section Ttile start -->
                        <div class="section-title text-lg-start text-center"> 
                            <h2 class="wow fadeInUp" data-wow-delay="0.50s">Welcome!</h2>
                        </div>
                        <!-- Section Title end -->

                        <!-- Contact Form start -->
                        <div class="contact-form wow fadeInUp" data-wow-delay="0.75s">
                            <form id="loginForm" action="#" method="POST" data-toggle="validator">
                                <input name="csrf_token" type="hidden" value="<?= CSRF::get() ?>" />
                                <input name="method" type="hidden" value="register" />
                                <input name="return" type="hidden" value="<?= $_GET['return']??'' ?>" />
                                <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Your name" required />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="email" name="email" class="form-control" id="name" placeholder="Email" required />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="password" name="pass" class="form-control" id="name" placeholder="Password" required />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-12 mb-4">
                                        Remember: <input type="checkbox" name="remember" class="form-check-input" checked value="1" /> 
                                    </div>
  

                                    <div class="col-md-12 text-center">
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn-default">Register Now</button>
                                        </div>
                                        <div id="msgSubmit" class="h3 text-left "></div>
                                    </div>
                                    
                                <div class="mt-3 d-flex justify-content-between">
                                    <a href="/account?return=<?= $_GET['return']??'' ?>">Login?</a> 
                                </div>

                                </div>
                            </form>
                           
                        </div>
                        <!-- Contact Form end -->
                    </div>
                    <!-- Contact Form Section End -->
                </div>

                


            </div>
        </div>
    </div> 
 

    <!-- Contact Us Page End -->

    <script>
        const loginForm = document.querySelector('#loginForm');
        const submitBtn = loginForm.querySelector("[type='submit']");
        const btnContent = submitBtn.innerHTML;
        const feedback = document.querySelector('#msgSubmit');

        loginForm.addEventListener('submit', async (e)=> {
            e.preventDefault();
            submitBtn.disabled = true;
            submitBtn.innerHTML = `<div class="spinner-border"role="status"><span class="visually-hidden">Loading...</span></div>`;
            feedback.classList.remove('alert', 'alert-danger', 'alert-success'); 
            feedback.innerHTML = '';
            
                try {
                    const response = await fetch('/myapp/requests', {body:new FormData(loginForm), method:"POST"});
                    const result = await response.json();

                    if (!response.ok || (result.error)) {
                        throw new Error(result.msg || "Something went wrong please try again");
                    }

                    feedback.innerHTML = result.msg;
                    feedback.classList.add('alert', 'alert-success'); 
                    if (result.cl[1].length > 0) { setCookie(`<?= REMEMBER_COOKIE_NAME ?>`, result.cl[1]); } 
                    if (result.cl[0].length > 0) { window.location.href = result.cl[0]; } 
                    
                } catch (error) {   
                    showToast(error);
                    feedback.innerHTML = error;
                    feedback.classList.add('alert', 'alert-danger');
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = btnContent;
                }
        })

    </script>

    <?php require 'public/includes/footer.inc.php' ?>
</body>
</html>