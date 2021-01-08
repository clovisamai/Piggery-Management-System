<?php 
$page_title = "Add Farm Expense"; 
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
                        <h4 class="text-themecolor">Add Expense</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Add Expense</li>
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
                                $user_id = $_SESSION['id'];

                                $name = $_POST['name'];
                                $subject = $_POST['subject'];
                                $price = $_POST['price'];
                                $durability = $_POST['durability']; 
                                $purpose = $_POST['purpose'];
                                $available = $_POST['available'];
                                $desc = $_POST['desc'];

                            $insert = mysqli_query($conn, "INSERT INTO `expenses`(`id`, `name`, `subject`, `price`, `durability`, `purpose`, `available`, `description`, `user_id`) VALUES (null,'$name','$subject','$price','$durability','$purpose','$available','$desc', '$user_id')");
                            
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
                                <h5 class="card-title text-uppercase">EXPENSE DETAILS</h5>
                                <form class="form-material m-t-40" method="post" action="add-expense.php">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="example-text">Name of Expense</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" id="example-text" name="name" class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="example-text">Subject of Expense</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" id="example-text" name="subject" class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="example-text">Price of Expense</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="number" id="example-text" name="price" class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="example-text">Expected Expense Durability</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" id="example-text" name="durability" class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-12">Purpose</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" name="purpose" required>
                                                    <option value="cleaning">Cleaning</option>
                                                    <option value="construction">Construction</option>
                                                    <option value="transport">Transport</option>
                                                    <option value="health">Health</option>
                                                    <option value="feeding">Feeding</option>
                                                
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="position">Available?</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" id="position" name="available" required class="form-control" placeholder="Is Expense in stock?">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12">Description</label>
                                            <div class="col-md-12">
                                                <textarea class="form-control" name="desc" required rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-r-10" name="submit">Submit</button>
                                    <button type="reset" class="btn btn-dark waves-effect waves-light">Reset</button>
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