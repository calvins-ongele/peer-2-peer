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
                        <h1 class="wow fadeInUp" data-wow-delay="0.25s">
                            <?php echo $this->_content[$this->pid]['title']??'' ?>
                            <?= CustomFunctions::editBtn($this->pid) ?>
                        </h1>
                        <ul class="breadcrumb wow fadeInUp" data-wow-delay="0.50s">
                            <li><a href="/">Home</a></li>
                            <li>Legal</li>
                        </ul>
                    </div>
                    <!-- Sub page Header end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Subpage Hero Section End --> 
     <!-- legal Page Section Start -->
    <div class="page-blog-single">
        <div class="container"> 

            <!-- Post Content Start -->
            <div class="row single-post-content">
                <div class="col-md-12">
                    <div class="row">
                         

                        <div class="col-md-12">
                            <iframe id="contentBody" style="width: 100%;height:100vh" ></iframe>
                            <?php //echo $this->_content[$this->pid]['body']??'' ?>  
                        </div>
                    </div>
                </div>
            </div>
            <!-- Post Content End -->
        </div>
    </div>
    <!-- legal Page Section End -->
 
 <script>
    const iframe = document.getElementById('contentBody'); 
    //iframe.addEventListener('load', () => { 
    //const iframeDoc = iframe.contentWindow.document; 
    const content = `<?= str_replace(['[company_name]', '[company_email]'], [$this->_settings['site_name'], $this->_settings['email']], $this->_content[$this->pid]['body']??'') ?>`;
    console.log(content)
    iframe.srcdoc = content;
    //});
 </script> 

    <?php require 'public/includes/footer.inc.php' ?>
</body>
</html>