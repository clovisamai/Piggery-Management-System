<?php 
$page_title = "Dashboard"; 
require("../../components/header.php");
?>
<body class="skin-blue fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <?php include("../../components/loader.php"); ?>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include("../../components/navbar.php"); ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <?php include("../../components/sidenav.php"); ?>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Dashboard</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Info box -->
                <!-- ============================================================== -->
                <!-- .row -->

                <?php 
                        if(isset($_POST['create_vet']))
                        {
                            $name = $_POST['name_vet'];
                            $email = $_POST['email_vet'];
                            $password = $_POST['password_vet'];
                            $hash = sha1($password);

                            $query = mysqli_query($conn,"SELECT * FROM users WHERE email = '$email' LIMIT 1");
                            $count = mysqli_num_rows($query);
                            if($count == 0){
                                $qry = mysqli_query($conn,"INSERT INTO `users`(`id`, `name`, `email`, `password`, `role`, `online`) VALUES (null,'$name','$email','$hash',2,0)");
                                if($query){?>
                                    <div class="alert alert-success alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong><i class="fa fa-check"></i> &nbsp; Vet Successfully Added</strong>
                                    </div>
                                <?php
                                } else{ ?>
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong><i class="fa fa-times"></i> &nbsp; Error adding Vet. Please try again</strong>
                                    </div>
                                <?php
                                }
                            } else{ ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-times"></i> &nbsp; <?php echo 'User with email address: '.$email.' already exists !' ?></strong>
                                </div>
                            <?php }
                        }

                        if(isset($_POST['reset_vet']))
                        {
                            $id = $_POST['vet_id'];
                            $password = sha1($_POST['vet_pass']);

                            $qry = mysqli_query($conn,"UPDATE `users` SET  `password` = '$password' WHERE `id`= $id ");
                                if($qry){?>
                                    <div class="alert alert-success alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong><i class="fa fa-check"></i> &nbsp; Password Changed Successfully</strong>
                                    </div>
                                <?php
                                } else{ ?>
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong><i class="fa fa-times"></i> &nbsp; Error changing password. Please try again</strong>
                                    </div>
                                <?php
                                }

                        }

                        if(isset($_POST['delete']))
                        {
                            $id = $_POST['the_id'];

                            $qry = mysqli_query($conn,"DELETE FROM `users` WHERE `id`= $id ");
                                if($qry){?>
                                    <div class="alert alert-success alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong><i class="fa fa-check"></i> &nbsp; Deleted Successfully</strong>
                                    </div>
                                <?php
                                } else{ ?>
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong><i class="fa fa-times"></i> &nbsp; Error deleting. Please try again</strong>
                                    </div>
                                <?php
                                }

                        }


                ?>

                <?php  $user_id = $_SESSION['id']; ?>

                <?php if($_SESSION['role'] == 0 ){ ?>

                    <div class="row">
                        <div class="col-md-8">
                                <div class="row">
                                    <div class="col-4 p-4">
                                            <?php
                                                $result = mysqli_query($conn,"SELECT * FROM users WHERE role = 1 ");
                                                $count = mysqli_num_rows($result);
                                            ?> 
                                            <h2 class="text-success"><?php echo $count; ?></h2>
                                            <h6 class="text-dark">PIG FARMER / FARMERS</h6>
                                    </div>
                                    <div class="col-4 p-4">
                                            <?php
                                                $result = mysqli_query($conn,"SELECT * FROM users WHERE role = 3 ");
                                                $count = mysqli_num_rows($result);
                                            ?> 
                                            <h2 class="text-success"><?php echo $count; ?></h2>
                                            <h6 class="text-dark">VET / VETS</h6>
                                    </div>
                                </div>

                                <h3>PIG FARMERS</h3>
                                <div class="card p-3">
                                <?php 
                                        $query = mysqli_query($conn,"SELECT * FROM users WHERE role = 1 ");
                                        while($row = mysqli_fetch_assoc($query)){
                                ?>
                                <div>
                                    <div class="card p-3">
                                        <div class="row">
                                        <div class="col-10">
                                            PIG FARMER
                                            <h4><?php echo $row['name']; ?></h4>
                                            <h6 class="text-muted"><?php echo $row['email']; ?></h6>
                                            <br>
                                            <div class="row">
                                                <div class="col-3">
                                                    <?php
                                                        $f_id = $row['id'];
                                                        $query_pigs = mysqli_query($conn,"SELECT * FROM pigs where `user_id` = '$f_id' ");
                                                        $count = mysqli_num_rows($query_pigs);
                                                    ?>
                                                    <h5>Total Pigs</h5>
                                                    <p><?php echo $count; ?></p>
                                                </div>    
                                                <div class="col-3">
                                                    <?php
                                                        $f_id = $row['id'];
                                                        $query_pigs = mysqli_query($conn,"SELECT * FROM pigs where `user_id` = '$f_id' and `available` = 'Yes' ");
                                                        $count = mysqli_num_rows($query_pigs);
                                                    ?>
                                                    <h5>Available Pigs</h5>
                                                    <p><?php echo $count; ?></p>
                                                </div>
                                                <div class="col-3">
                                                    <?php
                                                        $f_id = $row['id'];
                                                        $query_pigs = mysqli_query($conn,"SELECT * FROM pigs where `user_id` = '$f_id' and `available` = 'SOLD' ");
                                                        $count = mysqli_num_rows($query_pigs);
                                                    ?>
                                                    <h5>Sold Pigs</h5>
                                                    <p><?php echo $count; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 text-right">
                                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit_vet_modal<?php echo $row['id']; ?>">Edit Password</button>
                                            <form class="py-1" method="post" action="dash.php">
                                                <input type="text" hidden name="the_id" value="<?php echo $row['id']; ?>">
                                                <button class="btn btn-sm btn-danger" type="submit" name="delete">Delete</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>

                                    <div id="edit_vet_modal<?php echo $row['id']; ?>" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Password Reset</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="dash.php">
                                                        <input type="text" name="vet_id" hidden value="<?php echo $row['id']; ?>" class="form-control">
                                                        <div class="form-group">
                                                            <input type="text" name="vet_pass" class="form-control" placeholder="Enter new Password">
                                                        </div>
                                                        <button class="btn btn-info" name="reset_vet" type="submit">Change Password</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                                <?php } ?>
                                </div>
                        </div>
                        <div class="col-md-4">
                                <div class="card">
                                    <!-- Modal -->
                                    <button class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#responsive-modal">Add Vet</button>

                                    <div id="responsive-modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Vet Information</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="dash.php">
                                                        <div class="form-group">
                                                            <label class="control-label">Full Name</label>
                                                            <input type="text" name="name_vet" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Email</label>
                                                            <input type="email" name="email_vet" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Password</label>
                                                            <input type="text" name="password_vet" class="form-control">
                                                        </div>
                                                        <button class="btn btn-dark" type="reset">Reset</button>
                                                        <button class="btn btn-info" name="create_vet" type="submit">Add Vet</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </div>
                                    <div class="pt-1">
                                    </div>
                                <h3 class="text-right">VETS</h3>

                                
                                <?php 
                                        $query = mysqli_query($conn,"SELECT * FROM users WHERE role = 2 ");
                                        while($row = mysqli_fetch_assoc($query)){
                                ?>
                                <div>
                                    <div class="card p-3">
                                        <div class="row">
                                        <div class="col-9">
                                            VET
                                            <h4><?php echo $row['name']; ?></h4>
                                            <h6 class="text-muted"><?php echo $row['email']; ?></h6>
                                        </div>
                                        <div class="col-3 text-right">
                                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit_vet_modal<?php echo $row['id']; ?>">Edit Password</button>
                                            <form class="py-1" method="post" action="dash.php">
                                                <input type="text" hidden name="the_id" value="<?php echo $row['id']; ?>">
                                                <button class="btn btn-sm btn-danger" type="submit" name="delete">Delete</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>

                                    <div id="edit_vet_modal<?php echo $row['id']; ?>" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Vet Password Reset</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="dash.php">
                                                        <input type="text" name="vet_id" hidden value="<?php echo $row['id']; ?>" class="form-control">
                                                        <div class="form-group">
                                                            <input type="text" name="vet_pass" class="form-control" placeholder="Enter new Password">
                                                        </div>
                                                        <button class="btn btn-info" name="reset_vet" type="submit">Change Password</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                                <?php } ?>

                            </div>
                    </div>

                <?php } if($_SESSION['role'] == 1 ){ ?>

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-uppercase">Pig sales</h5>
                                    <div class="text-right"> <span class="text-muted">In comparison to No of Pigs Available</span>
                                    <?php
                                        $result = mysqli_query($conn,"SELECT * FROM sales WHERE Item = 'PIG' AND user_id = '$user_id' ");
                                        $countPigs = mysqli_num_rows($result);
                                        
                                        $q = mysqli_query($conn,"SELECT SUM(`amount`) AS Money FROM sales WHERE Item = 'PIG' AND user_id = '$user_id' ");
                                        $row = mysqli_fetch_assoc($q);
                                        $sum = $row['Money'];
                                    ?>
                                    <div class="pb-2"></div>
                                        <h3> UGX <?php echo $sum; ?></h3>
                                    <div class="pb-2"></div>
                                    </div>
                                    <?php
                                        $result = mysqli_query($conn,"SELECT * FROM pigs WHERE user_id = '$user_id' ");
                                        $countAllPigs = mysqli_num_rows($result);
                                        if($countPigs != 0){
                                        $percentage = $countPigs/$countAllPigs * 100;
                                        }else{
                                            $percentage = 0;
                                        }
                                    ?>
                                    <span class="text-success"><?php echo $percentage; ?>% of <?php echo $countAllPigs; ?> Pigs Sold</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" style="width: <?php echo $percentage; ?>%; height:6px;" role="progressbar"></div>
                                    </div>
                                    <div class="pb-4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-uppercase">Pigs Vaccinated</h5>
                                    <div class="pb-4"></div>
                                    <?php
                                        $result = mysqli_query($conn,"SELECT * FROM pigs WHERE vaccinated = 1 AND available = 'Yes' AND user_id = '$user_id' ");
                                        $countPigs = mysqli_num_rows($result);
                                    ?>
                                    <div class="text-right">
                                        <h1><?php echo $countPigs; ?></h1>
                                    </div>
                                    <?php
                                        $result = mysqli_query($conn,"SELECT * FROM pigs WHERE available = 'Yes' AND user_id = '$user_id' ");
                                        $countAllPigs = mysqli_num_rows($result);
                                        if($countPigs != 0){
                                        $percentage = $countPigs/$countAllPigs * 100;
                                        }else{
                                            $percentage = 0;
                                        }
                                    ?>
                                    <span class="text-primary"><?php echo $percentage; ?>%</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" style="width: <?php echo $percentage; ?>%; height:6px;" role="progressbar"></div>
                                    </div>
                                    <div class="pb-4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-uppercase">No of Pigs on Farm</h5>
                                    <div class="text-right pb-1 pr-3"> <span class="text-muted">Categorised in their Breeds</span>
                                    <div class="row pb-3 pt-3 text-right pr-2">
                                        <div class="col-4">
                                            <b>
                                            <?php
                                                $result = mysqli_query($conn,"SELECT * FROM pigs WHERE breed = 'exotic' AND available = 'Yes' AND user_id = '$user_id' ");
                                                $countPigs = mysqli_num_rows($result);
                                            ?>                                   
                                            <h2 class="text-danger"><?php echo $countPigs; ?></h2>
                                            <h6 class="text-dark" >Exotic</h6>
                                            </b>                                   
                                        </div>
                                        <div class="col-4">
                                            <b>
                                            <?php
                                                $result = mysqli_query($conn,"SELECT * FROM pigs WHERE breed = 'mixed' AND available = 'Yes' AND user_id = '$user_id' ");
                                                $countPigs = mysqli_num_rows($result);
                                            ?> 
                                            <h2 class="text-info"><?php echo $countPigs; ?></h2>
                                            <h6 class="text-dark">Mixed</h6>
                                            </b>                                   
                                        </div>
                                        <div class="col-4">
                                            <b>
                                            <?php
                                                $result = mysqli_query($conn,"SELECT * FROM pigs WHERE breed = 'local' AND available = 'Yes' AND user_id = '$user_id' ");
                                                $countPigs = mysqli_num_rows($result);
                                            ?> 
                                            <h2 class="text-success"><?php echo $countPigs; ?></h2>
                                            <h6 class="text-dark">Local</h6>
                                            </b>
                                        </div>
                                    </div>
                                        
                                    </div>
                                    
        
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-right text-success"> <span class="text-muted">Total value of Assets</span>
                                    <?php
                                        $q = mysqli_query($conn,"SELECT SUM(`price`) AS Money FROM assets WHERE user_id = '$user_id' ");
                                        $row = mysqli_fetch_assoc($q);
                                        $sum = $row['Money'];
                                    ?>
                                        <h4> UGX <?php echo $sum; ?></h4>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="text-right text-danger"> <span class="text-muted">Total value of Expenses</span>
                                    <?php
                                        $q = mysqli_query($conn,"SELECT SUM(`price`) AS Money FROM expenses WHERE user_id = '$user_id' ");
                                        $row = mysqli_fetch_assoc($q);
                                        $sum = $row['Money'];
                                    ?>
                                        <h4> UGX <?php echo $sum; ?></h4>
                                    </div>
                                    <!-- <span class="text-inverse">80%</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-inverse" style="width: 40%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title text-uppercase">Farm Earnings<br><small class="text-muted">UGX</small></h5>
                                        <div class="ml-auto">
                                            <ul class="list-inline font-12">
                                                <li><i class="fa fa-circle text-dark"></i> Pig Sales</li>
                                                <li><i class="fa fa-circle text-info"></i> Manure</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div id="morris-bar-chart" style="height:375px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card m-b-15">
                                        <div class="card-body">
                                            <h5 class="card-title text-uppercase">Earnings from Pigs</h5>
                                            <div class="row">
                                                <div class="col-6 m-t-30">
                                                <?php
                                                    $result = mysqli_query($conn,"SELECT * FROM sales WHERE Item = 'PIG' AND user_id = '$user_id' ");
                                                    $countPigs = mysqli_num_rows($result);

                                                    $q = mysqli_query($conn,"SELECT SUM(`amount`) AS Money FROM sales WHERE user_id = '$user_id' AND Item = 'PIG' ");
                                                    $row = mysqli_fetch_assoc($q);
                                                    $sum = $row['Money'];
                                                ?>
                                                    <h2 class="text-info">UGX <?php echo $sum; ?></h2>
                                                    <b>(<?php echo $countPigs; ?> Sale/Sales)</b> </div>
                                                <div class="col-6">
                                                    <div id="sparkline2dash" class="text-right"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card bg-info m-b-15">
                                        <div class="card-body">
                                            <h5 class="text-white card-title text-uppercase">Earning From Manure</h5>
                                            <div class="row">
                                                <div class="col-6 m-t-30">
                                                <?php
                                                    $result = mysqli_query($conn,"SELECT * FROM sales WHERE Item = 'MANURE' AND user_id = '$user_id' ");
                                                    $countPigs = mysqli_num_rows($result);

                                                    $q = mysqli_query($conn,"SELECT SUM(`amount`) AS Money FROM sales WHERE user_id = '$user_id' AND Item = 'MANURE' ");
                                                    $row = mysqli_fetch_assoc($q);
                                                    $sum = $row['Money'];
                                                ?>
                                                    <h2 class="text-white">UGX <?php echo $sum; ?></h2>
                                                    <b>(<?php echo $countPigs; ?> Trip/Trips)</b> </div>
                                                <div class="col-md-6 col-sm-6 col-6">
                                                    <div id="sales1" class="text-right"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <?php } if($_SESSION['role'] == 2 ){ 
                    echo '<script>window.location="../messages/inbox.php"</script>';
                } ?>


            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
<?php
    require("../../components/footer.php");
?>