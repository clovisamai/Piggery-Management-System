<?php 
$page_title = "Add Sale"; 
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
                        <h4 class="text-themecolor">Add Sale</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Add Sale</li>
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

                    <div class="col-md-12">
                    <?php
                        if(isset($_POST['submit_pig']))
                        {
                                $user_id = $_SESSION['id'];
                                $pig_id = $_POST['pig_id'];
                                $price = $_POST['price'];

                                $date = $_POST['date'];
                                $dtime = strtotime($date);
                                $dos =date("Y-m-d", $dtime);
                                
                                $client_name = $_POST['client'];
                                $client_no = $_POST['client_no'];

                                $client = $client_name.'_'.$client_no;

                                $desc = $_POST['desc'];                            

                            $insert = mysqli_query($conn, "INSERT INTO `sales`(`id`, `Item`, `item_id`, `amount`, `description`, `soldOn`, `toClient`, `user_id`) VALUES (null,'PIG','$pig_id','$price','$desc','$dos','$client','$user_id')");

                            if($insert){
                                $sold = mysqli_query($conn, "UPDATE `pigs` SET `available`='SOLD' WHERE id='$pig_id' ");                                
                                ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-check"></i> &nbsp; Pig Sale Recorded Successfully</strong>
                                </div>
                            <?php
                            }else{ ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-times"></i> &nbsp; Error creating pig sale record. Please try again</strong>
                                </div>
                            <?php
                            }
                        }
                        if(isset($_POST['submit_manure']))
                        {
                                $user_id = $_SESSION['id'];
                                $price = $_POST['price'];

                                $date = $_POST['date'];
                                $dtime = strtotime($date);
                                $dos =date("Y-m-d", $dtime);
                                
                                $client_name = $_POST['client'];
                                $client_no = $_POST['client_no'];

                                $client = $client_name.'_'.$client_no;

                                $desc = $_POST['desc'];                            

                            $insert = mysqli_query($conn, "INSERT INTO `sales`(`id`, `Item`, `item_id`, `amount`, `description`, `soldOn`, `toClient`, `user_id`) VALUES (null,'MANURE','NILL','$price','$desc','$dos','$client','$user_id')");

                            if($insert){ ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-check"></i> &nbsp; Manure Sale Recorded Successfully</strong>
                                </div>
                            <?php
                            }else{ ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-times"></i> &nbsp; Error creating manure sale record. Please try again</strong>
                                </div>
                            <?php
                            }
                        }
                        ?>


                        <div class="card">
                            <div class="card-body p-b-0">
                                <h4 class="card-title">Register Sale</h4>
                                <h6 class="card-subtitle">Select type to make a sale</h6>
                            </div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs customtab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#pig">
                                        <span class="hidden-sm-up"><i class="fas fa-utensils"></i></span> <span
                                            class="hidden-xs-down">Pig</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#manure">
                                        <span class="hidden-sm-up"><i class="fas fa-truck-loading"></i></span> <span
                                            class="hidden-xs-down">Manure</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="pig" role="tabpanel">
                                    <div class="p-20">
                                        <div class="card-body">
                                            <h5 class="card-title text-uppercase">PIG DETAILS</h5>
                                            <form class="form-material m-t-40" method="post" action="add-sale.php">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-sm-12">Pig</label>
                                                        
                                                        <div class="col-sm-12">
                                                            <select class="form-control" name="pig_id" required>
                                                            <option>Select Pig</option>
                                                            <?php
                                                                $user_id = $_SESSION['id'];
                                                                $query_pigs = mysqli_query($conn,"SELECT * FROM pigs where `user_id` = '$user_id' and `available` = 'Yes' ");
                                                                if(mysqli_num_rows($query_pigs)>0){
                                                                    while($row = mysqli_fetch_array($query_pigs)){
                                                            ?>
                                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                            <?php } } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Sale Price
                                                            (UGX)</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="number" id="example-text" name="price"
                                                                class="form-control" placeholder="Enter Price" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="bdate">Date of Sale</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="bdate" name="date"
                                                                class="form-control mydatepicker"
                                                                placeholder="Enter Date of Sale" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Client Name</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-text" name="client"
                                                                class="form-control" placeholder="Enter Client Name"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Client
                                                            Contact</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-text" name="client_no"
                                                                class="form-control phone-inputmask"
                                                                placeholder="(077)000-0000"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" rows="5" name="desc"
                                                        placeholder="Enter any details about the transaction e.g paid in cash"></textarea>
                                                </div>

                                                <button type="submit"
                                                    class="btn btn-info waves-effect waves-light m-r-10"
                                                    name="submit_pig">Submit</button>
                                                <button type="reset"
                                                    class="btn btn-dark waves-effect waves-light">Reset</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="manure" role="tabpanel">
                                <div class="p-20">
                                        <div class="card-body">
                                            <h5 class="card-title text-uppercase">MANURE DETAILS</h5>
                                            <form class="form-material m-t-40" method="post" action="add-sale.php">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Sale Price
                                                            (UGX)</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="number" id="example-text" name="price"
                                                                class="form-control" placeholder="Enter Price" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="bdate">Date of Sale</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="bdate" name="date"
                                                                class="form-control mydatepicker"
                                                                placeholder="Enter Date of Sale" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Client Name</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-text" name="client"
                                                                class="form-control" placeholder="Enter Client Name"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Client
                                                            Contact</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-text" name="client_no"
                                                                class="form-control phone-inputmask"
                                                                placeholder="(077)000-0000"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" rows="5" name="desc"
                                                        placeholder="Enter any details about the transaction e.g paid in cash"></textarea>
                                                </div>

                                                <button type="submit"
                                                    class="btn btn-info waves-effect waves-light m-r-10"
                                                    name="submit_manure">Submit</button>
                                                <button type="reset"
                                                    class="btn btn-dark waves-effect waves-light">Reset</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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