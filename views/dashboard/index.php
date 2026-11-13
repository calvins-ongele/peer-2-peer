<!DOCTYPE html>
<html lang="en">

<head> 
    <?php require 'includes/header.inc.php' ?> 
    <style>
        #chart-container {
           width: 700px;
           height: 450px;
        }
      </style>
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <main class="wrapper">
         
        <?php   require 'includes/sidebar.inc.php' ?> 
        
        <div class="content-wrapper px-4 py-2">
            <div class="content-header"> 
            </div>
            <div class="content px-2">
                
                    <div class='container alert' >
                        
                        <?php if (isset($_GET['unauthorized'])) { ?>
                        <div class='alert alert-danger'>
                            You tried to visit unauthorized page. Please ask admins to elevate your role.
                        </div>
                        <?php } ?>
                         
                        
                        <div class='row'>  
                        
            				<div class="col-md-4 ml-xx2" >
            					<div class="single-bolg hover01 card alert" style='border-bottom:2px solid var(--blend)' >
            						<center><figure><i class="fas fa-users " alt="slide 1" style="font-size: 40px;color:var(--blend)"></i></figure></center>
            					 
            						<div class="blog-content"><br>
            							<span class='h4'>Total Users: <a  style='color:blue' href='/<?= PROFILE_NAV ?>/users'><?= number_format($this->more['users']) ?></a> </span>
            						</div>
            					</div>
            				</div>
            				
            				<div class="col-md-4 ml-xx2" >
            					<div class="single-bolg hover01 card alert" style='border-bottom:2px solid var(--blend)' >
            						<center><figure><i class="fas fa-headphones " alt="slide 1" style="font-size: 40px;color:var(--blend)"></i></figure></center>
            					 
            						<div class="blog-content"><br>
            							<span class='h4'>Support Tickets: <a  style='color:blue' href='/<?= PROFILE_NAV ?>/support_tickets'><?= number_format($this->more['contact']) ?></a> </span>
            						</div>
            					</div>
            				</div>
            				
            				<div class="col-md-4 ml-xx2" >
            					<div class="single-bolg hover01 card alert" style='border-bottom:2px solid var(--blend)' >
            						<center><figure><i class="fas fa-bar-chart " alt="slide 1" style="font-size: 40px;color:var(--blend)"></i></figure></center>
            					 
            						<div class="blog-content"><br>
            							<span class='h4'>Total Visits: <a  style='color:blue' href='/<?= PROFILE_NAV ?>/reports'><?= number_format($this->more['visits']) ?></a> </span>
            						</div>
            					</div>
            				</div>
                    
            			  
            				<hr>
            				<div class="card mb-4">
                        		<div class="card-header"> 
                        			Your Recent Logs [Max-50] 
                        		</div>
                        		<div class="card-body" style='max-height: 600px; overflow:auto;'>
                        			<div class="table-responsive">
                        				<table class="table table-bordered">
                        					<thead>
                        					    <tr>
                        							<th>Date</th> 
                        							<th>Narration</th>
                        							<th>Activity type</th> 
                        					    </tr>
                        					</thead>
                        					<tbody>
                        							    <?php  foreach($this->logs as $row) {   ?>
                        									<tr> 
                        									    <td><?php echo date('d-m-Y', $row['l_date'])   ?></td>
                        										<td><?php echo $row['l_message']   ?></td>  
                        										<td><?php echo $row['l_type'] ?></td>     
                        								         
                        								    </tr>
                        								    <?php } ?>
                        							 
                        					</tbody>
                        				</table>
                        			</div>
                        		</div>
                        	</div>
            				<hr>
            				
            				<div class="col-md-12 ml-xx2" style='background:black' >
            				    
            				</div>
                     
                            
                        </div>
                        
                        
 
                    </div>
                
                 
            </div>
        </div>
        
        
        <?php require 'includes/footer.inc.php' ?>
        
     
    </main> 
 
</body>

</html>