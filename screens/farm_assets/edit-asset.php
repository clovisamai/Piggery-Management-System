<?php 
$page_title = "Edit Farm Asset"; 
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
            <?php include("../../components/sidenav.php"); ?>
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
                        <h4 class="text-themecolor">Edit Asset</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Edit Asset</li>
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
                <div class="row">
                <?php 
                    $id = $_POST['asset_id'];
                    $query = mysqli_query($conn,"SELECT * FROM assets WHERE id = '$id' ");
                    $row = mysqli_fetch_assoc($query);
                ?>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">ASSET DETAILS</h5>
                                <form class="form-material m-t-40" method="post" action="all-assets.php" enctype="multipart/form-data">
                                    <input type="hidden" name="edit_id" value="<?php echo $id; ?>">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="example-text">Name of Asset</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" id="example-text" name="name" class="form-control" placeholder="" required value="<?php  echo $row['name']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="example-text">Subject of Asset</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" id="example-text" name="subject" class="form-control" placeholder="" required value="<?php  echo $row['subject']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="example-text">Price of Asset (UGX)</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="number" id="example-text" name="price" class="form-control" placeholder="" required value="<?php  echo $row['price']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="example-text">Expected Asset Durability</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" id="example-text" name="durability" class="form-control" placeholder="" value="<?php  echo $row['durability']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-12">Purpose</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" name="purpose" required>
                                                    <option <?php if ($row['purpose'] == "cleaning"){ ?> selected="selected" <?php } ?> value="cleaning">Cleaning</option>
                                                    <option <?php if ($row['purpose'] == "construction"){ ?> selected="selected" <?php } ?> value="construction">Construction</option>
                                                    <option <?php if ($row['purpose'] == "transport"){ ?> selected="selected" <?php } ?> value="transport">Transport</option>
                                                    <option <?php if ($row['purpose'] == "health"){ ?> selected="selected" <?php } ?> value="health">Health</option>
                                                    <option <?php if ($row['purpose'] == "feeding"){ ?> selected="selected" <?php } ?> value="feeding">Feeding</option>
                                                
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="position">Available?</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" id="available" required name="available" class="form-control" placeholder="Is asset in stock?" value="<?php  echo $row['available']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12">Description</label>
                                            <div class="col-md-12">
                                                <textarea class="form-control" required name="desc" rows="3"><?php  echo $row['description']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-r-10" name="edit">Submit</button>
                                    <button type="reset" class="btn btn-dark waves-effect waves-light">Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
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