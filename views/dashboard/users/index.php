<!DOCTYPE html>
<html lang="en">

<head> 
    <?php require ADMIN . 'includes/header.inc.php' ?> 
     <style>
        .star {
          font-size: 2rem;
          color: lightgray;
          cursor: pointer;
        }
    
        .star.selected {
          color: gold;
        }
      </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <main class="wrapper">
         
        <?php   require ADMIN . 'includes/sidebar.inc.php' ?>
        
        
            <div class="content-wrapper px-4 py-2">
            <div class="content-header"> 
                <a href='#'   class='btn btn-sm btn-primary openmod' >Users</a> 
            </div>
            <div class="content px-2">
                
                    <div class='container alert'>
                        <div class='table-responsive'>
                            <table class='table table-striped table-hover'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th> 
                                        <th>Role</th>  
                                        <th>Created at</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                     
                                    
                                    $i = 0; foreach($this->users[1] as $row) { $i++; ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td> <?php echo CustomFunctions::maskString($row['username']) ?>  
                                            <a class=' btn btn-sm btn-secondary ' href='/<?= PROFILE_NAV ?>/users/edit?id=<?php echo $row['id'] ?>'  ><i class='fa fa-pencil'></i></a>
                                        </td>
                                        <td><?php echo $row['user_email'] ?>   </td>  
                                        <td><?php echo $row['user_role'] ?> </td>
                                        <td><?php echo explode(' ',$row['created_at'])[0] ?> </td> 
                                         
                                        
                                        <td><a style='color:red' class='dropUsers' href='#' rel='<?php echo $row['id'] ?>'   ><i class='fa fa-trash'></i></a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                             
                        </div>
                        
                        
                     <div class="clearfix <?php echo empty($this->users[0]) ? "hidden" : ""; ?>">
                        <ul class="pagination table-responsive">
                            <li class="page-item">
                                <?php $pg = PROFILE_NAV;  ?>
                                <a href='/<?= $pg ?>/users/?pg=<?= $this->currentpage > 1 ? $this->currentpage - 1 : 1; ?>' class="page-link">Previous</a>
                            </li>
                            <?php   
                                for($currentPage = 1; $currentPage <= ceil($this->users[0] / $this->_settings['user_loop_sequence']); $currentPage++){
                                    echo"
                                    <li class='page-item'><a href='/$pg/users/?pg=$currentPage' class='page-link'> $currentPage </a></li>";
                                }
                            
                                if ( (ceil($this->users[0] / $this->_settings['user_loop_sequence'])) > ($_GET['pg'] ?? 1) )  {  
                            ?>
                            
                            <li class="page-item"><a href='/<?= $pg ?>/users/?pg=<?= $this->currentpage + 1; ?>' class="page-link ">Next</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                     
                        
                        
 
                    </div>
                
                 
            </div>
        </div>
        
        
        <?php require ADMIN.'includes/footer.inc.php' ?> 
        
  <script>
    $(document).ready(function () {
         
        
        
             $('.dropUsers').click(function(e) {
                e.preventDefault();
                var form = new FormData();
                form.append('id', $(this).attr('rel') ); 
                
                if (confirm("Are you sure?")) {
                    const data = _data(form, 'delete_users');
                    if (data['error'] == 'true') alert(data['msg']);
                    else {
                        alert(data['msg']);
                        location.reload();
                    }
                }
             
            });
       
    });
  </script>
    </main> 
 
</body>

</html>
