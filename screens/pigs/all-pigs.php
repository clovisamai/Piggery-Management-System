<?php 
$page_title = "All Pigs"; 
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
                        <h4 class="text-themecolor">All Pigs</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">All Pigs</li>
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
                <div class="col-md-12">
                    <?php 
                        if(isset($_POST['delete']))
                        {
                            $id = $_POST['pig_id'];
                            $query = mysqli_query($conn,"DELETE FROM pigs WHERE id = $id ");
                            if($query){?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-check"></i> &nbsp; Record Successfully Deleted</strong>
                                </div>
                            <?php
                            }else{ ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-times"></i> &nbsp; Error deleing record. Please try again</strong>
                                </div>
                            <?php
                            }
                        }

                        if(isset($_POST['quarantine'])){
                            $id = $_POST['pig_id'];
                            $query = mysqli_query($conn,"UPDATE pigs SET `quarantine` = 1 WHERE id = $id ");
                            if($query){?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-check"></i> &nbsp; Pig Quarantined Successfully</strong>
                                </div>
                            <?php
                            }else{ ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-times"></i> &nbsp; Failed to Quarantine Pig. Please try again</strong>
                                </div>
                            <?php
                            }
                        }

                        if(isset($_POST['edit']))
                        {
                            $edit_id = $_POST['edit_id'];

                            if(isset($_FILES['pigphoto']['tmp_name'])){
                                $name = $_POST['name'];
                                $date = $_POST['bdate'];
                                $dtime = strtotime($date);
                                $dob = date("Y-m-d", $dtime); 
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

                                
                                    // if (!$move) {
                                    //     $fileerror = $_FILES['pigphoto']['error'];
                                    //     $message = $upload_errors[$fileerror];
                                    // }
                                }
                                $update = mysqli_query($conn, "UPDATE `pigs` SET `name`='$name', `DOB`='$dob', `gender`='$gender', `image`='$path1', `breed`='$breed', `price_p`='$price', `description`='$desc', `weight`='$weight', `vaccinated`='$vac' WHERE id='$edit_id'");
                            }else{
                                $update = mysqli_query($conn, "UPDATE `pigs` SET `name`='$name', `DOB`='$dob', `gender`='$gender', `breed`='$breed', `price_p`='$price', `description`='$desc', `weight`='$weight', `vaccinated`='$vac' WHERE id='$edit_id'");
                            }

                            if($update){?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-check"></i> &nbsp; Record Successfully Updated</strong>
                                </div>
                            <?php
                            }else{ ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-times"></i> &nbsp; Error updating record. Please try again</strong>
                                </div>
                            <?php
                            }
                        }
                    
                    ?>
                    
                    <div class="row el-element-overlay">
                        <?php
                            $user_id = $_SESSION['id'];
                            $query_pigs = mysqli_query($conn,"SELECT * FROM pigs where `user_id` = '$user_id' and `available` = 'Yes' ");
                            if(mysqli_num_rows($query_pigs)>0){
                                while($row = mysqli_fetch_array($query_pigs)){
                        ?>
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="el-card-item">
                                        <div class="el-card-avatar el-overlay-1"> 
                                            <div style="background-image:url('<?php echo $row['image']; ?>'); background-repeat:no-repeat; background-size:cover; background-position:center; height:200px;">
                                            </div>
                                        </div>
                                        <div class="el-card-content p-3 ribbon-wrapper card">
                                            <h5 class="card-title text-uppercase"><?php echo $row['name']; ?> 
                                            <?php if( $row['quarantine'] == '1'){?>
                                            <span class="badge badge-pill badge-primary text-white ml-auto">In Quarantine</span>
                                            <?php } ?>
                                            </h5> 
                                            <small class="text-capitalize"><?php echo $row['breed']; ?></small>
                                            <br/>
                                            <?php
                                                $birth = new DateTime( $row['DOB'] ); 
                                                $today = new DateTime();
                                                $diff = $today->diff($birth);
                                                $age_y = $diff->y;
                                                $age_m = $diff->m;
                                                $age_d = $diff->d;

                                                echo "<small>Age: ".$age_y." Years ".$age_m." Months ".$age_m." Days</small>";
                                            ?>                                            
                                            <div class="row pt-3 text-right">
                                                <form method="post" action="all-pigs.php">
                                                    <input hidden name="pig_id" value="<?php echo $row['id'] ?>">
                                                    <div class="row px-3">
                                                        <?php if( $row['quarantine'] == '0' | $row['quarantine'] == ''){?>
                                                        <button  type="submit" onclick="return confirm('Are you sure you want to quarantine this pig ?')"  name="quarantine" class="btn btn-warning px-1">Qurantine</button> &nbsp;
                                                        <?php } ?>
                                                        <button formaction="edit-pig.php" class="btn btn-info px-1">Edit</button>&nbsp;
                                                        <button  type="submit" onclick="return confirm('Are you sure you want to delete this pig ?')" name="delete" class="btn btn-danger px-1">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                                }
                            } else { ?>
                            <div class="container h-100">
                                <div class="row h-100 align-items-center justify-content-center">
                                <h4 class="pt-5">There are no available pigs registered in the database</h4>
                                </div>
                            </div>
                        <?php  }  ?>
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