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
         
        <?php  require ADMIN . 'includes/sidebar.inc.php' ?>
        
        <!--
        '', '', '', '','', '',''
-->
            <div class="content-wrapper px-4 py-2">
            <div class="row" cxlass="content-header d-flex justify-content-between">  
                <div class="col-md-5"><a href='#'   class='btn btn-sm btn-primary  ' >Games</a> </div>
                <div class="col-md-7 ">
                    <section class="" style="display: flex; justify-content:space-between; "> 
                    <div>
                        <label>Filter by Status</label> 
                    <select class="form-control" id="filterByStatus">
                        <option value="" >All</option>
                        <option value="<?= CustomFunctions::formatDynamicUrl('status','pending') ?>" <?= ($_GET['status']??'')=='pending'?'selected':'' ?> >Pending</option>
                        <option value="<?= CustomFunctions::formatDynamicUrl('status','in_progress') ?>" <?= ($_GET['status']??'')=='in_progress'?'selected':'' ?> >In Progress</option>
                        <option value="<?= CustomFunctions::formatDynamicUrl('status','disputed') ?>" <?= ($_GET['status']??'')=='disputed'?'selected':'' ?> >Disputed</option>
                        <option value="<?= CustomFunctions::formatDynamicUrl('status','completed') ?>" <?= ($_GET['status']??'')=='completed'?'selected':'' ?> >Completed</option>
                        <option value="<?= CustomFunctions::formatDynamicUrl('status','abandoned_after_start') ?>" <?= ($_GET['status']??'')=='abandoned_after_start'?'selected':'' ?> >Abandoned after start</option>
                        <option value="<?= CustomFunctions::formatDynamicUrl('status','cancelled_b4_start') ?>" <?= ($_GET['status']??'')=='cancelled_b4_start'?'selected':'' ?> >Cancelled before start</option>
                        <option value="<?= CustomFunctions::formatDynamicUrl('status','overriden_by_admin') ?>" <?= ($_GET['status']??'')=='overriden_by_admin'?'selected':'' ?> >Admin Override</option>

                    </select>
                    </div>
                    <div>
                        <label>Order By</label> 
                        <select class="form-control" id="OrderBy">
                            <option value="" >All</option> 
                            <option value="<?= CustomFunctions::formatDynamicUrl('orderby','date:asc') ?>" <?= ($_GET['orderby']??'')=='date:asc'?'selected':'' ?> >Date Asc</option>
                            <option value="<?= CustomFunctions::formatDynamicUrl('orderby','date:desc') ?>" <?= ($_GET['orderby']??'')=='date:desc'?'selected':'' ?> >Date Desc</option>
                        </select> 
                    </div>
                    <div>
                        <label>Public status</label> 
                        <select class="form-control" id="gameType">
                            <option value="" >All</option> 
                            <option value="<?= CustomFunctions::formatDynamicUrl('gameType','public') ?>" <?= ($_GET['gameType']??'')=='public'?'selected':'' ?> >Public</option>
                            <option value="<?= CustomFunctions::formatDynamicUrl('gameType','private') ?>" <?= ($_GET['gameType']??'')=='private'?'selected':'' ?> >Private</option>
                        </select> 
                    </div>
                    <div>
                        <label>Clear filters</label>
                        <a href="/dashboard/games/index" id="ClearFilters" class="btn-danger form-control">X Clear filters</a>
                    </div>
                    
</section>
                </div>
            </div>
            <div class="content px-2">
                
                    <div class='container alert'>
                        <div class='table-responsive'>
                            <table class='table table-striped table-hover'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Players</th> 
                                        <th>Stake Cost</th>  
                                        <th>Escrow Value</th> 
                                        <th>Status</th> 
                                        <th>Created at</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                    if (empty($this->games['data'])) { ?>
                                        <tr >
                                            <td colspan="8">
                                                <div class="alert alert-danger mx-3">
                                                    There's no data here. Try different filters.
                                                </div>
                                            </td>
                                        </tr>
                                    <?php }
                                     
                                    
                                    foreach($this->games['data'] as $i => $row) {   
                                      $gameStatus = CustomFunctions::gameStatus($row['status']);    
                                    ?>
                                    <tr>
                                        <td><?php echo $i+1 ?></td>
                                        <td> <?php echo ($row['title'] ) ?>   </td>
                                        <td><?php echo $row['total_players'] ?>   </td>  
                                        <td><?php echo $row['stake_cost'] ?> </td>
                                        <td><?php echo number_format(($row['stake_cost']*$row['total_players']),2)  ?> </td>  
                                        <td>
                                            <span class="<?= $gameStatus['color'] ?>"><?php echo $gameStatus['text'] ?></span>
                                        </td>
                                        <td><?php echo explode(' ',$row['created_at'])[0] ?> </td>  
                                        
                                        <td>
                                            <a class=' btn btn-sm btn-primary ' href='/user/games/<?php echo $row['game_url'] ?>'  ><i class='fa fa-pencil'></i> Override</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                             
                        </div>
                        
                        
                   
                        <?php 
                            $paginationData = $this->games;
                            require 'public/sections/pagination.section.php'
                        ?>
                     
                        
                        
 
                    </div>
                
                 
            </div>
        </div>
        
        
        <?php require ADMIN.'includes/footer.inc.php' ?> 
        <script>
            const filterByStatus = document.querySelector("#filterByStatus");
            const OrderBy = document.querySelector("#OrderBy");
            const gameType = document.querySelector("#gameType");

            OrderBy.addEventListener('change',()=> { window.location.href=`${OrderBy.value}`; });
            filterByStatus.addEventListener('change',()=> { window.location.href=`${filterByStatus.value}`; });
            gameType.addEventListener('change',()=> { window.location.href=`${gameType.value}`; });

             
        </script>
 
    </main> 
 
</body>

</html>
