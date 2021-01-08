<?php 
$page_title = "Quarantine"; 
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
                        <h4 class="text-themecolor">Quarantine</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Quarantine</li>
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
                        
                        if(isset($_POST['un_quarantine'])){
                            $id = $_POST['pig_id'];
                            $query = mysqli_query($conn,"UPDATE pigs SET `quarantine` = 0 WHERE id = $id ");
                            if($query){?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-check"></i> &nbsp; Pig Un-quarantined Successfully</strong>
                                </div>
                            <?php
                            }else{ ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-times"></i> &nbsp; Failed to Un-quarantine Pig. Please try again</strong>
                                </div>
                            <?php
                            }
                        }
                        
                    ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Quarantined Pigs</h5>
                                <hr>
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>DOB</th>
                                                <th>Gender</th>
                                                <th>Description</th>
                                                <th>Weight</th>
                                                <th>Vaccinated</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $x=1;
                                            $user_id = $_SESSION['id'];
                                            $query_pigs = mysqli_query($conn,"SELECT * FROM pigs WHERE `user_id` = '$user_id' AND `quarantine` = 1 ");
                                            if(mysqli_num_rows($query_pigs)>0){
                                                while($row = mysqli_fetch_array($query_pigs)){
                                        ?>
                                            <tr>
                                                <td><?php echo $x++; ?></td>
                                                <td><img src="<?php echo $row['image']; ?>" width="100px" height="100px"></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['DOB']; ?></td>
                                                <td><?php echo $row['gender']; ?></td>                                        
                                                <td><?php echo $row['description']; ?></td>
                                                <td><?php echo $row['weight']; ?></td>
                                                <td><?php echo $row['vaccinated']; ?></td>
                                                <td>
                                                    <form method="post" action="quarantine.php">
                                                        <input hidden name="pig_id" value="<?php echo $row['id'] ?>">
                                                        <div class="row pt-2 pb-1 px-2">
                                                            <button  type="submit" onclick="return confirm('Are you sure you want to un-quarantine this pig ?')" name="un_quarantine" class="py-1 btn btn-warning d-none d-lg-block m-l-15">Un-quarantine</button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            }  ?>
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