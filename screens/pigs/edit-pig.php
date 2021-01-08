<?php 
$page_title = "Edit Pig"; 
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
                        <h4 class="text-themecolor">Edit Pig</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Edit Pig</li>
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
                <?php 
                    $id = $_POST['pig_id'];
                    $query = mysqli_query($conn,"SELECT * FROM pigs WHERE id = '$id' ");
                    $row = mysqli_fetch_assoc($query);
                ?>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Basic Information</h5>
                                <form class="form-material form-horizontal" enctype="multipart/form-data" method="post" action="all-pigs.php">
                                    <input type="hidden" name="edit_id" value="<?php echo $id; ?>">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="example-text">Name</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" id="example-text" name="name" class="form-control text-muted" placeholder="enter your name" value="<?php echo $row['name']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="bdate">Date of Birth</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" id="bdate" name="bdate" class="form-control text-muted mydatepicker" placeholder="enter your birth date" value="<?php echo $row['DOB']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-12">Gender</label>
                                            <div class="col-sm-12">
                                                <select class="form-control text-muted" name="gender">
                                                    <option <?php if ($row['gender'] == "bow"){ ?> selected="selected" <?php } ?> value="bow" >Bow </option>
                                                    <option <?php if ($row['gender'] == "sow"){ ?> selected="selected" <?php } ?> value="sow">Sow </option>
                                                    <option <?php if ($row['gender'] == "boar"){ ?> selected="selected" <?php } ?> value="boar">Boar </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-12">Pig Image</label>
                                            <div class="col-sm-12 pb-2">
                                                <img class="img-responsive" src="<?php echo $row['image']; ?>" alt="" style="max-width:120px;">
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                    <div class="form-control text-muted" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="pigphoto"> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-12" for="dept">Breed</label>
                                            <div class="col-sm-12">
                                                <select class="form-control text-muted" id="dept" name="breed">
                                                    <option <?php if ($row['breed'] == "local"){ ?> selected="selected" <?php } ?> > Local</option>
                                                    <option <?php if ($row['breed'] == "mixed"){ ?> selected="selected" <?php } ?> > Mixed</option>
                                                    <option <?php if ($row['breed'] == "exotic"){ ?> selected="selected" <?php } ?> > Exotic</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="position">Weight (Kgs)</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" id="position" name="weight" class="form-control text-muted" placeholder="Pig size" value="<?php echo $row['weight']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="position">Purchase Price (UGX) </span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="number" id="position" name="price" class="form-control" placeholder="e.g. 50,000" required value="<?php echo $row['price_p']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12">Description</label>
                                            <div class="col-md-12">
                                                <textarea class="form-control text-muted" rows="3" name="desc" ><?php echo $row['description']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="vac">Vaccinated</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="radio" name="vac" id="vac" value="1" required <?php if ($row['vaccinated'] == 1){ ?> checked <?php } ?> > Yes
                                                &nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="vac" id="vac" value="0" required <?php if ($row['vaccinated'] == 0){ ?> checked <?php } ?> > No
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-r-10" name="edit">Submit</button>
                                    <button type="Reset" class="btn btn-dark waves-effect waves-light">Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
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