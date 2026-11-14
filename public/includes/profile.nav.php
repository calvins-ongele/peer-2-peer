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
                             <li class="nav-items first-item"><a class="nav-link <?= CustomFunctions::isActiveNav('user') ?>" href="/user">Games</a></li>

                             <li class="nav-items"><a class="nav-link <?= CustomFunctions::isActiveNav('balance', 1) ?>" href="/user/balance">Balance <span>$<?= $this->_me['user_balance'] ?? '0.00' ?></span></a></li>

                             <li class="nav-items"><a class="nav-link <?= CustomFunctions::isActiveNav('transactions') ?>" href="/user/transactions">Transactions </a></li>

                             <li class="nav-items"><a class="nav-link <?= CustomFunctions::isActiveNav('change-password') ?>" href="/user/change-password">Change Password</a></li>

                             <li class="nav-items btn-login"><a class="nav-link" href="/dashboard/logout">Logout</a></li>
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

 <style>
     .fab {
         position: fixed;
         bottom: 24px;
         right: 0px;
         z-index: 1000;  
     } 
 </style>
 <div class="fab">
     <a href="/games/start" class="btn btn-warning" aria-label="Create new game" title="Create New Game">
         <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
             <line x1="12" y1="5" x2="12" y2="19"></line>
             <line x1="5" y1="12" x2="19" y2="12"></line>
         </svg> New Game
     </a>
 </div>