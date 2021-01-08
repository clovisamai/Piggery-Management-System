<?php 
$page_title = "Add Pig"; 
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
                        <h4 class="text-themecolor">Add Pig</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Add Pig</li>
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
                    <div class="col-sm-12">
                    <?php
                        if(isset($_POST['submit']))
                        {
                            if(isset($_FILES['pigphoto']['tmp_name'])){
                                $user_id = $_SESSION['id'];

                                $name = $_POST['name'];
                                $date = $_POST['bdate'];
                                $dtime = strtotime($date);
                                $dob =date("Y-m-d", $dtime); 
                                $gender = $_POST['gender'];
                                $breed = $_POST['breed'];
                                $price = $_POST['price'];
                                $desc = $_POST['desc'];
                                $weight = $_POST['weight'];
                                $vac = $_POST['vac'];
                            
                                $res1_name = basename($_FILES['pigphoto']['name']);
                                $tmp_name = $_FILES['pigphoto']['tmp_name'];
                                $type = $_FILES['pigphoto']['type'];
                                $max_size = 2097152;
                                $size = $_FILES['pigphoto']['size'];

                                if (isset($res1_name)) {
                                    $location = '../../uploads/';
                                    $move = move_uploaded_file($tmp_name, $location.$res1_name);
                                    $path1 = $location.$res1_name;

                                
                                    if (!$move) {
                                        $fileerror = $_FILES['pigphoto']['error'];
                                        $message = $upload_errors[$fileerror];
                                    }
                                }
                            }

                            $insert = mysqli_query($conn, "INSERT INTO `pigs`(`id`, `name`, `DOB`, `gender`, `image`, `breed`, `price_p`, `description`, `weight`, `vaccinated`, `available`, `user_id`) VALUES (null,'$name','$dob','$gender','$path1','$breed','$price','$desc','$weight','$vac','Yes','$user_id')");

                            if($insert){?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-check"></i> &nbsp; Record Successfully Created</strong>
                                </div>
                            <?php
                            }else{ ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-times"></i> &nbsp; Error creating record. Please try again</strong>
                                </div>
                            <?php
                            }
                        }
                        ?>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Basic Information</h5>
                                <form class="form-material" method="post" action="add-pig.php" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="example-text">Name</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" id="example-text" name="name" class="form-control" placeholder="Pig's name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="bdate">Date of Birth</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" id="bdate" name="bdate" class="form-control mydatepicker" placeholder="Pig's birth date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-12">Gender</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" name="gender" required>
                                                    <option value="">Select Gender</option>
                                                    <option value="boar">boar</option>
                                                    <option value="sow">sow</option>
                                                    <option value="pigglet">pigglet</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-12">Pig Image</label>
                                            <div class="col-sm-12">
                                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                    <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="pigphoto" required> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-12">Breed</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" name="breed" required>
                                                    <option value="">Select Breed</option>
                                                    <option value="exotic">Exotic</option>
                                                    <option value="local">Local</option>
                                                    <option value="mixed">Mixed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="position">Purchase Price (UGX) </span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="number" id="position" name="price" class="form-control" placeholder="e.g. 50,000" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12">Description</label>
                                            <div class="col-md-12">
                                                <textarea class="form-control" rows="3" name="desc" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="url">Weight (Kgs)</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="number" id="url" name="weight" class="form-control" placeholder="Either at time of buying or birth" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="vac">Vaccinated</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="radio" name="vac" id="vac" value="1" required> Yes
                                                &nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="vac" id="vac" value="0" required> No
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-r-10" name="submit">Submit</button>
                                    <button type="reset" class="btn btn-dark waves-effect waves-light">Clear</button>
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