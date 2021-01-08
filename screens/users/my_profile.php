<?php 
$page_title = "My Profile"; 
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
                        <h4 class="text-themecolor">My Profile</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">My Profile</li>
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
                        if(isset($_POST['change_info']))
                        {
                            $id = $_POST['user_id'];
                            $name = $_POST['name'];
                            $email = $_POST['email'];

                            $edit = mysqli_query($conn,"UPDATE `users` SET `name` = '$name', `email` = '$email' WHERE id = '$id' ");
                            if($edit){ ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-check"></i> &nbsp; User Information Updated Successfully</strong>
                                </div>
                            <?php
                            }else{ ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-times"></i> &nbsp; Error creating updating user information. Please try again</strong>
                                </div>
                            <?php
                            }
                        }


                        if(isset($_POST['change_password']))
                        {
                            $id = $_POST['user_id'];
                            $pass = $_POST['oldpass'];
                            $opassword = sha1($pass);
                            $npassword = $_POST['newpass'];
                            $cpassword = $_POST['connewpass'];

                            if ($npassword == $cpassword) {
                                $harsh = sha1($npassword);

                                $sql = ("SELECT * FROM users WHERE password = '$opassword' AND id ='$id' ");
                                $result = mysqli_query($conn,$sql);
                                $count = mysqli_num_rows($result);
                                $row = mysqli_fetch_array($result);

                                if($count == 1){
                                    $edit = mysqli_query($conn,"UPDATE `users` SET password = '$harsh' WHERE id = '$id' ");
                                    if($edit){ ?>
                                        <div class="alert alert-success alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong><i class="fa fa-check"></i> &nbsp; User Password Updated Successfully</strong>
                                        </div>
                                        <?php
                                    }else{ ?>
                                        <div class="alert alert-success alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong><i class="fa fa-check"></i> &nbsp; User Password Update Failed</strong>
                                        </div>
                                        <?php
                                    }
                                }else{ ?>
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong><i class="fa fa-times"></i> &nbsp; Invalid Old Password. Please try again</strong>
                                    </div>
                                    <?php
                                }
                            }else{ ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-times"></i> &nbsp; New password and Confirm password do not match</strong>
                                </div>
                            <?php
                            }
                        }
                    ?>

                        <div class="card">
                            <div class="card-body">
                            <?php 
                                $user_id = $_SESSION['id'];
                                $query = mysqli_query($conn,"SELECT * FROM users WHERE id = '$user_id' ");
                                $row = mysqli_fetch_assoc($query);
                            ?>
                                <h3 class="pb-2">Account Information</h3>
                                <form class="form-material form-horizontal" enctype="multipart/form-data" method="post" action="my_profile.php">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
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
                                            <label class="col-md-12" for="position">Email</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="email" id="position" name="email" class="form-control text-muted" placeholder="Pig size" value="<?php echo $row['email']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-r-10" name="change_info">Submit</button>
                                    <button type="Reset" class="btn btn-dark waves-effect waves-light">Reset</button>
                                </form>
                                <div class="p-3"></div>
                                <h3 class="pb-2">Password</h3>
                                <form class="form-material form-horizontal" enctype="multipart/form-data" method="post" action="my_profile.php">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="position">Old Password </span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="password" id="position" name="oldpass" class="form-control" placeholder="Enter Old Password" required >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="position">New Password </span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="password" id="position" name="newpass" class="form-control" placeholder="Enter New Password" required >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="position">Confirm New Password </span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="password" id="position" name="connewpass" class="form-control" placeholder="Enter New Password" required >
                                            </div>
                                        </div>
                                    </div>
                                                                    
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-r-10" name="change_password">Submit</button>
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