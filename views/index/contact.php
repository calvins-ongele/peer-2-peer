<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'public/includes/header.inc.php' ?>
</head>
<body class="tt-magic-cursor">

    <!-- Preloader Start -->
     <?php require 'public/includes/navbar.inc.php' ?>
    <!-- main Header end -->

    <!-- Subpage Hero Section Start -->
    <div class="subpage-header">
        <div class="container">
            <div class="row">
                <div class="co-md-12">
                    <!-- Sub page Header start -->
                    <div class="subpage-header-box">
                        <h1 class="wow fadeInUp" data-wow-delay="0.25s">Contact Us</h1>
                        <ul class="breadcrumb wow fadeInUp" data-wow-delay="0.50s">
                            <li><a href="/">Home</a></li>
                            <li>Contact Us</li>
                        </ul>
                    </div>
                    <!-- Sub page Header end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Subpage Hero Section End -->

    <!-- Contact Us Page Start -->
    <div class="page-contact-us">
        
    <div class="container">
            <div class="row">

                <div class="col-lg-6 col-12">
                    <!-- Contact Form Section Start -->
                    <div class="contact-form-box box-border-linear-gradient wow fadeInUp" data-wow-delay="0.50s">
                        <!-- Section Ttile start -->
                        <div class="section-title text-lg-start text-center">
                            <h3 class="wow fadeInUp" data-wow-delay="0.25s">Have Any Questions?</h3>
                            <h2 class="wow fadeInUp" data-wow-delay="0.50s">Drop Us a Line</h2>
                        </div>
                        <!-- Section Title end -->

                        <!-- Contact Form start -->
                        <div class="contact-form wow fadeInUp" data-wow-delay="0.75s">
                            <form id="contactForm" action="#" method="POST" data-toggle="validator">
                                <input name="csrf_token" type="hidden" value="<?= CSRF::get() ?>" />
                                <input name="method" type="hidden" value="contactform" />
                                <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" required />
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="email" name ="email" class="form-control" id="email" placeholder="Email" required />
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone"
                                            required />
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <textarea name="message" class="form-control" id="msg" rows="4" placeholder="Write a Message" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn-default">Send Now</button>
                                        <div id="msgSubmit" class="h3 text-left d-none"></div>
                                    </div>
                                </div>
                            </form> 
                        </div>
                        <!-- Contact Form end -->
                    </div>
                    <!-- Contact Form Section End -->
                </div>

                
                <div class="col-lg-6 col-12">
                    <div class="row">
                        <div class="col-md-12 text-lg-start text-center">
                            <!-- Section Title start -->
                            <div class="section-title wow fadeInUp" data-wow-delay="0.50s">
                                <h3 class="wow fadeInUp" data-wow-delay="0.25s">Get In Touch</h3>
                                <h2 class="wow fadeInUp" data-wow-delay="0.50s">Contact Information</h2>
                            </div>
                            <!-- Section Title end -->
                        </div>

                        <div class="col-md-6 text-lg-start text-center">
                            <!-- Contact Infomation start -->
                            <div class="contact-infomation-box box-border-linear-gradient wow fadeInUp"
                                data-wow-delay="0.50s">
                                <div class="contact-info-icon">
                                    <img src="/public/assets/uploads/icon-location.svg" alt="">
                                </div>
                                <div class="contact-info-body">
                                    <h3>Location</h3>
                                    <p><?= $this->_settings['company_address'] ?></p>
                                </div>
                            </div>
                            <!-- Contact Infomation end -->
                        </div>

                        <div class="col-md-6 text-lg-start text-center">
                            <!-- Contact Infomation start -->
                            <div class="contact-infomation-box box-border-linear-gradient wow fadeInUp"
                                data-wow-delay="0.75s">
                                <div class="contact-info-icon">
                                    <img src="/public/assets/uploads/icon-phone-mail-support.svg" alt="">
                                </div>
                                <div class="contact-info-body">
                                    <h3>24/7 Support</h3>
                                    <p><a href="tel:<?= $this->_settings['tel'] ?>"><?= $this->_settings['tel'] ?></a></p>
                                    <p><a href="mailto:<?= $this->_settings['email'] ?>"><?= $this->_settings['email'] ?></a></p>
                                </div>
                            </div>
                            <!-- Contact Infomation end -->
                        </div>

                        <div class="col-md-12 text-lg-start text-center">
                            <!-- Follow Us Section start -->
                            <div class="contact-follow-us">
                                <h2 class="wow fadeInUp" data-wow-delay="1.0s">Follow us on</h2>
                                <div class="follow-us-icon">
                                    <ul>
                                        <li class="wow fadeInUp" data-wow-delay="1.25s"><a href="<?= $this->_settings['social_facebook']??'#' ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
                                        <li class="wow fadeInUp" data-wow-delay="1.50s"><a href="<?= $this->_settings['social_instagram']??'#' ?>"><i class="fa-brands fa-instagram"></i></a></li>
                                        <li class="wow fadeInUp" data-wow-delay="1.75s"><a href="<?= $this->_settings['social_twitter']??'#' ?>"><i class="fa-brands fa-twitter"></i></a></li>
                                        <li class="wow fadeInUp" data-wow-delay="2.0s"><a href="<?= $this->_settings['social_linkedin']??'#' ?>"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Follow Us Section end -->
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div> 
 

    <!-- Contact Us Page End -->

    <?php require 'public/includes/footer.inc.php' ?>
</body>
</html>