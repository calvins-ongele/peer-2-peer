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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script> 

        async function rejectInvitation(gameId, gameTitle) { 
            const form = new FormData();
            form.set('method', 'rejectInvitation');
            form.set('csrf_token', '<?= CSRF::get() ?>');
            form.set('game_id', gameId);
            form.set('title', gameTitle);
            form.set('game_id', gameId);

            const confirm = await confirmRejection(gameTitle);
            if (!confirm) return;
            
                try {
                    const response = await fetch('/myapp/requests', {body:form, method:"POST"});
                    const result = await response.json();

                    if (!response.ok || (result.error)) {
                        throw new Error(result.msg || "Something went wrong please try again");
                    }

                    await Swal.fire({title: `Success. ${gameTitle}'s invitation was declined successfully.`, icon: "success" });
                    showToast( `Success. ${gameTitle}'s invitation was declined successfully.`, 'bg-success'); 
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);

                    
                } catch (error) {
                    showToast(error); 
                } finally { }
        }

        async function confirmRejection(gameTitle) {
            
              const result = await Swal.fire({
                title: "Are you sure?",
                html: `<bold style="font-weight:bold">${gameTitle}'s</bold> invitation will be rejected!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, I Confirm!",
                allowOutsideClick:false
                });

                return result.isConfirmed;
        }

    </script>

    <?php require 'public/includes/footer.inc.php' ?>
</body>
</html>