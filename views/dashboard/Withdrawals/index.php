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
                        <option value="<?= CustomFunctions::formatDynamicUrl('status','rejected') ?>" <?= ($_GET['status']??'')=='rejected'?'selected':'' ?> >Rejected</option> 
                        <option value="<?= CustomFunctions::formatDynamicUrl('status','completed') ?>" <?= ($_GET['status']??'')=='completed'?'selected':'' ?> >Completed</option> 
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
                        <label>Clear filters</label>
                        <a href="/dashboard/withdrawals/index" id="ClearFilters" class="btn-danger form-control">X Clear filters</a>
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
                                        <th>Username</th>
                                        <th>Amount</th> 
                                        <th>Method</th>   
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
                                        <td> <?php echo ($row['username'] ) ?>   </td>
                                        <td><?php echo $row['amount'] ?>   </td>  
                                        <td><?php echo $row['method'] ?> </td>  
                                        <td>
                                            <span class="<?= $gameStatus['color'] ?>"><?php echo $gameStatus['text'] ?></span>
                                        </td>
                                        <td><?php echo explode(' ',$row['created_at'])[0] ?> </td>  
                                        
                                        <td>
                                            <a class=' btn btn-sm btn-danger ' href='#' onclick="takeAction('rejected', `<?= $row['id'] ?>`); return false;"  ><i class='fa fa-times'></i> Reject</a>
                                            <a class=' btn btn-sm btn-success ' href='#' onclick="takeAction('completed', `<?= $row['id'] ?>`);return false;"  ><i class='fa fa-check'></i> Approve</a>
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
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <?php require ADMIN.'includes/footer.inc.php' ?> 
        <script>
            const filterByStatus = document.querySelector("#filterByStatus");
            const OrderBy = document.querySelector("#OrderBy"); 

            OrderBy.addEventListener('change',()=> { window.location.href=`${OrderBy.value}`; });
            filterByStatus.addEventListener('change',()=> { window.location.href=`${filterByStatus.value}`; }); 

            async function takeAction(status, rowId) {
                const form = new FormData();
                form.set('status', status);
                form.set('row_id', rowId);
                form.set('admin', 1); 
                form.set('method', 'withdrawalRequest');
                form.set('csrf_token', '<?= CSRF::get() ?>');
                const confirmed = await awaitConfirmation(status);

                if ( ! confirmed ) return;

                    const response = await fetch('/myapp/requests', {method:'POST', body:form});
                    const result   = await response.json(); 

                    if (result.error) {
                        Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: result.msg 
                        });

                        return;
                    }

                    await Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: result.msg 
                        });
                    location.reload();
                
            }

            async function awaitConfirmation(status) {
                const result = await Swal.fire({
                title: "Are you sure?",
                text: `Confirm that the withdrawal will be ${status}.`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Continue!"
                });

                return result.isConfirmed;
            }

             
        </script>
 
    </main> 
 
</body>

</html>
