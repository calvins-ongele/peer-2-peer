 <!-- Preloader Start -->
    <div class="preloader">
        <div class="preloader-box">
            <img src="/public/assets/system/loader.svg" alt="">
        </div>
    </div>
    <!-- Preloader End -->

    <!-- Magic Cursor Start -->
	<div id="magic-cursor">
		<div id="ball"></div>
	</div>
	<!-- Magic Cursor End -->

    <!-- main Header Start -->
    <header class="main-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-8">
                    <!-- Logo Start -->
                    <a class="navbar-brand" href="/">
                        <img src="/public/assets/uploads/logo.svg" alt="Logo">
                    </a>
                    <!-- Logo End -->
                </div>

                <div class="col-lg-9 col-md-8 col-4">
                    <!--Main Menu Start -->
                    <nav class="navbar navbar-expand-lg justify-content-end">
                        <div class="collapse navbar-collapse main-menu">
                            <ul class="navbar-nav mr-auto" id="menu">
                                <li class="nav-items first-item"><a class="nav-link <?= CustomFunctions::isActiveNav('') ?>" href="/">Home</a></li>
                                <li class="nav-items"><a class="nav-link <?= CustomFunctions::isActiveNav('about-us') ?>" href="/about-us">About us</a></li>
                                <li class="nav-items"><a class="nav-link <?= CustomFunctions::isActiveNav('games') ?>" href="/games">Join Games</a></li>
                                <li class="nav-items"><a class="nav-link <?= CustomFunctions::isActiveNav('blog') ?>" href="/blog">Blog</a></li>
                                <!-- <li class="nav-items submenu"><a class="nav-link" href="#">Pages</a>
                                    <ul>
                                        <li class="nav-items"><a class="nav-link" href="/blog">Blog Archive</a></li>
                                        <li class="nav-items"><a class="nav-link" href="blog-single.html">Blog Single</a></li>
                                        <li class="nav-items"><a class="nav-link" href="promotions.html">Promotions</a></li>
                                        <li class="nav-items"><a class="nav-link" href="faq.html">FAQs</a></li>
                                        <li class="nav-items"><a class="nav-link" href="404.html">404 Error</a></li>
                                    </ul>
                                </li> -->
                                <li class="nav-items"><a class="nav-link <?= CustomFunctions::isActiveNav('contact-us') ?> " href="/contact-us">Contact</a></li>
                                <li class="nav-items btn-joinnow"><a class="nav-link" href="/games/start">Start a Game</a></li>
                                <li class="nav-items btn-login"><a class="nav-link" href="/account">Login</a></li>
                            </ul>
                        </div>

                        <div class="navbar-toggle"></div>
                    </nav>
                    <!-- Main Menu End -->
                </div>
                <div class="responsive-menu"></div>
            </div>
        </div>
    </header>