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

        <?php require 'public/sections/wager-history.section.php' ?>
        
     
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