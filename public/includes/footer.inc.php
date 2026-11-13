 <div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header"> 
      <strong class="me-auto">Feedback</strong>
      <small>Just Now..</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>
</div>


 <!-- Footer Start -->
    <footer>
        <!-- Scrolling Ticker Section Start -->
        <div class="scrolling-ticker">
             
        </div>
        <!-- Scrolling Ticker Section End -->

        
        <!-- Mega Footer Start -->
        <div class="footer-mega">
            <div class="container">
                <div class="row">
                    <!-- Footer About start -->
                    <div class="col-lg-4 col-12 text-lg-start text-center">
                        <div class="footer-about">
                            <!-- Footer Logo start -->
                            <div class="footer-logo">
                                <img src="/public/assets/uploads/logo.svg" alt="">
                            </div>
                            <!-- Footer Logo end -->

                            <!-- Footer Payment icon start -->
                            <div class="footer-payment-method">
                                <h2>We Accept Paymemt</h2>
                                <div class="footer-payment-icon"> 
                                    <div class="footer-payment-item box-border-linear-gradient">
                                        <img src="/public/assets/uploads/mpesa.png" alt="">
                                    </div> 
                                    <div class="footer-payment-item box-border-linear-gradient">
                                        <img src="/public/assets/uploads/icon-paypal.svg" alt="">
                                    </div>
                                    <div class="footer-payment-item box-border-linear-gradient">
                                        <img src="/public/assets/uploads/crypto_accepted.png" alt="">
                                    </div>
                                    <div class="footer-payment-item box-border-linear-gradient">
                                        <img src="/public/assets/uploads/icon-visa.svg" alt="">
                                    </div>

                                    <div class="footer-payment-item box-border-linear-gradient">
                                        <img src="/public/assets/uploads/icon-mastercard.svg" alt="">
                                    </div>

                                </div>
                            </div>
                            <!-- Footer Payment icon end -->
                        </div>
                    </div>
                    <!-- Footer About end -->

                    <!-- Footer Quick Links start -->
                    <div class="col-lg-5 col-md-8 col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="footer-links">
                                    <h2>Popular Games</h2>
                                    <ul id="popularGamesFooter" > 
                                        <li><a href="#">Promotions</a></li> 
                                    </ul>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="footer-links">
                                    <h2>Info Centre</h2>
                                    <ul>
                                        <li><a href="/about-us">About Us</a></li>
                                        <li><a href="/contact-us">Contact us</a></li> 
                                        <li><a href="/legal/terms-of-use">Terms of Use</a></li>
                                        <li><a href="/legal/privacy-policy">Privacy Policy</a></li>
                                        <li><a href="/legal/dispute-resolution">Dispute Resolution</a></li>
                                        <li><a href="/legal/refund-policy">Refund Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Quick Links ends -->

                    <!-- Footer Follow us start -->
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="follow-us">
                            <h2>Follow Us</h2>

                            <ul>
                                <li><a href="<?= $this->_settings['social_facebook']??'#' ?>"><i class="fa-brands fa-facebook-f"></i> Facebook</a></li>
                                <li><a href="<?= $this->_settings['social_instagram']??'#' ?>"><i class="fa-brands fa-instagram"></i> Instagram</a></li>
                                <li><a href="<?= $this->_settings['social_twitter']??'#' ?>"><i class="fa-brands fa-x-twitter"></i> Twitter</a></li>
                                <li><a href="<?= $this->_settings['social_linkedin']??'#' ?>"><i class="fa-brands fa-linkedin-in"></i> Linkedin</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Follow us end -->
                </div>

                
            </div>
        </div>
        <!-- Mega Footer Ends -->

        <!-- Footer Copyright Start -->
        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <!-- Footer Copyright Text start -->
                    <div class="col-md-8 text-md-start text-center">
                        <div class="copyright-text">
                            <p>Copyright © <script>document.write(new Date().getFullYear())</script> <?= $this->_settings['site_name'] ?>. All rights reserved.</p>
                        </div>
                    </div>
                    <!-- Footer Copyright Text end -->

                    <!-- Footer SSL Text start -->
                    <div class="col-md-4 text-md-end text-center">
                        <div class="ssl-note">
                            <p><i class="fa-solid fa-lock"></i> SSL Secured</p>
                        </div>
                    </div>
                    <!-- Footer SSL Text end -->
                </div>
            </div>
        </div>
        <!-- Footer Copyright End -->
    </footer>
    <!-- Footer End -->


    <!-- Jquery Library File -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!-- Bootstrap js file -->
    <script src="/public/js/bootstrap.min.js"></script>
    <script src="/public/js/custom-functions.js?v=<?= CODE_VERSION ?>"></script>
    <!-- Validator js file -->
    <script src="/public/js/validator.min.js"></script>
    <!-- SlickNav js file -->
    <script src="/public/js/jquery.slicknav.js"></script>
    <!-- Magnific js file -->
    <script src="/public/js/jquery.magnific-popup.min.js"></script>
    <!-- Swiper js file -->
    <script src="/public/js/swiper-bundle.min.js"></script>
    <!-- Counter js file -->
    <script src="/public/js/jquery.waypoints.min.js"></script>
    <script src="/public/js/countUp.umd.js"></script>
    <script src="/public/js/counter.min.js"></script>
    <!-- SmoothScroll js file-->
    <script src="/public/js/lenis.min.js"></script>
    <!-- MagicCursor js file-->
    <script src="/public/js/gsap.min.js"></script>
	<script src="/public/js/magiccursor.js"></script>
    <!-- Wow js file -->
    <script src="/public/js/wow.js"></script>
    <!-- Main Custom js file -->
    <script src="/public/js/function.js"></script>
    <!-- Theme Panel js file -->
    <script src="https://demo.awaikenthemes.com/assets/js/theme-panel-dynamic.js"></script>
  
    <script src="/public/static/custom-main.js?v=<?= rand(); ?>" type="text/javascript"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() { 

            fetchPopulatMatches();

            async function fetchPopulatMatches() {
                const form = new FormData();
                form.set('csrf_token', '<?= CSRF::get() ?>');
                form.set('method', 'last6PopularMatches');
                
                try {
                    const response = await fetch('/myapp/requests', { method: "POST",  body: form });
                    const result = await response.json();
                    if ((!response.ok) || result.error) {
                        throw new Error(result.msg || "Something went wrong. Please try again.");
                    } 
                    const matches = JSON.parse(result.msg);console.log(matches);
                    let matchesHtml = '';
                    let topSlots = '';
                    matches.forEach(match => {
                        console.log(match);
                        matchesHtml += `<li><a href="/games/${match.gameId}" class='text-uppercase' title='${match.title} (${match.total_players} Players)'>#${match.gameId}</a></li>`;
                        topSlots += `
                         <div class="col-md-3">
                            <div class="slot-item box-border-linear-gradient wow fadeInUp" data-wow-delay="0.05s">
                                <div class="slot-header">
                                    <div class="slot-playnow">
                                        <a href="/games/${match.gameId}" class="btn-default">Play Now</a>
                                    </div>

                                    <div class="slot-img">
                                        <img src="/public/assets/uploads/dummy.jpg" alt="${match.title}">
                                    </div>
                                </div>

                                <div class="slot-body text-center">
                                    <h3>${match.title} (${match.total_players} Players)</h3> 
                                </div>
                            </div>
                        </div>
                        `;
                    });

                    document.querySelector('#popularGamesFooter').innerHTML = matchesHtml;
                    const topSlotsHome = document.querySelector('#topSlotsHome');
                    if (topSlotsHome) topSlotsHome.innerHTML = topSlots;

                } catch (error) { console.log(error); }
            }
        });
    </script>
 
 


