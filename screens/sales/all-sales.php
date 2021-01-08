<?php 
$page_title = "All Sales"; 
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
                        <h4 class="text-themecolor">Sales</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">All Sales</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                    <?php 
                        if(isset($_POST['delete']))
                        {
                            $id = $_POST['sale_id'];
                            $type = $_POST['type'];
                            $pig_id = $_POST['pig_id'];
                            $query = mysqli_query($conn,"DELETE FROM sales WHERE id = $id ");
                            if($query){
                                if($type == 'PIG'){
                                    $sold = mysqli_query($conn, "UPDATE `pigs` SET `available`='Yes' WHERE id='$pig_id' ");                                
                                    if($sold){
                            ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-check"></i> &nbsp; Record Successfully Deleted</strong>
                                </div>
                            <?php
                                    }else{
                            ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-check"></i> &nbsp; Record Deleted. Failed to revert pig</strong>
                                </div>
                            <?php
                                    }
                                }    
                            }else{ ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-times"></i> &nbsp; Error deleing record. Please try again</strong>
                                </div>
                            <?php
                            }
                        }
                    ?>


                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Sales Details</h5>
                                <hr>
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Item</th>
                                                <th>Price</th>
                                                <th>Sale Date</th>
                                                <th>Description</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $user_id = $_SESSION['id'];
                                                $x=1;
                                                $query_sales = mysqli_query($conn,"SELECT * FROM sales where `user_id` = '$user_id' ");
                                                if(mysqli_num_rows($query_sales)>0){
                                                    while($row = mysqli_fetch_array($query_sales)){
                                            ?>
                                            <tr>
                                                <td><?php echo $x++; ?></td>
                                                <td><?php echo $row['Item']; ?></a></td>
                                                <td><?php echo $row['amount'].' UGX'; ?></td>
                                                <td><?php echo $row['soldOn']; ?></td>
                                                <td><?php echo $row['description']; ?></td>                                        
                                                <td>
                                                    <form method="post" action="all-sales.php">
                                                        <input hidden name="sale_id" value="<?php echo $row['id'] ?>">
                                                        <input hidden name="type" value="<?php echo $row['Item'] ?>">
                                                        <input hidden name="pig_id" value="<?php echo $row['item_id'] ?>">
                                                        <div class="row float-right pt-2 pb-1 px-2">
                                                            <button  type="submit" formaction="view-sale.php" name="view" class="py-1 btn btn-info d-none d-lg-block m-l-15">View</button>
                                                            <button  type="submit" onclick="return confirm('Are you sure you want to delete this sale ?')" name="delete" class="py-1 btn btn-danger d-none d-lg-block m-l-15">Delete</button>
                                                        </div>
                                                    </form> 
                                                </td>
                                            </tr>
                                            <?php }} ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
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