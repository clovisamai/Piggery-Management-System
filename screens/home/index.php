<?php 
$page_title = "Home"; 
require("../../components/header2.php");
?>
<body class="skin-blue fixed-layout" style="background-color: white;">
    <style>
        a {
            color: white;
        }
    </style>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <?php include("../../components/loader.php"); ?>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
    <header class="header" style="background-color:#004274;">	    
			<div class="branding">
				<div class="container-fluid">
					<nav class="navbar navbar-expand-lg" >
						<div class="site-logo mr-5 text-white">
                            <a href="../home/index.php">    
                                <img src="../../assets/images/logo-light-icon.png" alt="homepage" class="dark-logo" />
                                <b style="color: white;"><?php echo $SYS_NAME; ?></b>
                            </a>
                        </div>    
						
						<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
							<span> </span>
							<span> </span>
							<span> </span>
						</button>
						
						<div class="collapse navbar-collapse pt-3 pt-lg-0" id="navigation">
														
							<ul class="navbar-nav ml-auto">
								<li class="nav-item mr-lg-3">
									<a class="nav-link mt-1 mb-3 mb-lg-0" href="../auth/index.php">Sign In</a>
                                </li>
                                <li class="nav-item mr-lg-3">
									<a class="nav-link mt-1 mb-3 mb-lg-0" href="../auth/register.php">Register</a>
								</li>
							</ul><!--//navbar-nav-->
						</div>
					</nav>
					
				</div><!--//container-->
			</div><!--//branding-->
        </header><!--//header-->
        
        <section>
        <div class="container-fluid jumbotron text-center py-4" style="background-color: #004274; border-radius:0rem">
            <h1 style="color:white; font-size: 200px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:bolder"> <?php echo $SYS_NAME; ?></h1>
            <h5 class="py-3 text-white">You're one stop centre for Pigs</h5>
        </div>

        <div class="px-3">
                    <?php
                        if(isset($_POST['inquire']))
                        {
                            $user_id = $_POST['user_id'];
                            $pig_id = $_POST['pig_id'];
                            $contact = $_POST['client_no'];
                            $name = $_POST['name'];
                            
                            $insert = mysqli_query($conn, "INSERT INTO `inbox`(`id`, `fromUser`, `toUser`, `subject`, `message`) VALUES (null,'$name','$user_id','INQUIRY','$contact')");

                            if($insert){ ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-check"></i> &nbsp; Inquiry submitted Successfully</strong>
                                </div>
                            <?php
                            }else{ ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong><i class="fa fa-times"></i> &nbsp; Error submitting inquiry. Please try again</strong>
                                </div>
                            <?php
                            }
                        }
                    ?>
        </div>

            <div class="row">

            

                <div class="col-md-9">
                    <div class="p-2"></div>
                    <div class="row el-element-overlay px-3">
                        <?php
                            $query_pigs = mysqli_query($conn,"SELECT * FROM pigs where `available` = 'Yes' ");
                            if(mysqli_num_rows($query_pigs)>0){
                                while($row = mysqli_fetch_array($query_pigs)){
                        ?>
                            <div class="col-lg-3 col-md-6">
                                <div class="card shadow-sm">
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
                                            <small class="text-capitalize text-info"><?php echo $row['weight']; ?> kg/kgs</small>
                                            <small class="text-capitalize"><?php echo $row['breed']; ?></small>
                                            <?php
                                                $birth = new DateTime( $row['DOB'] ); 
                                                $today = new DateTime();
                                                $diff = $today->diff($birth);
                                                $age_y = $diff->y;
                                                $age_m = $diff->m;
                                                $age_d = $diff->d;

                                                echo "<small class='text-muted'>Age: ".$age_y." Years ".$age_m." Months ".$age_m." Days</small>";
                                            ?>                                            
                                            <div class="row pt-3 pb-2 text-left px-2">
                                                <button data-toggle="modal" data-target="#inquire_modal<?php echo $row['id']; ?>" class="py-1 btn btn-info">Inqure</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="inquire_modal<?php echo $row['id']; ?>" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Inquiry</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="pb-3" style="background-image:url('<?php echo $row['image']; ?>'); background-repeat:no-repeat; background-size:cover; background-position:center; height:150px;">
                                            </div>
                                            <h5 class="card-title text-uppercase pt-2"><?php echo $row['name']; ?> 
                                            <?php if( $row['quarantine'] == '1'){?>
                                            <span class="badge badge-pill badge-primary text-white ml-auto">In Quarantine</span>
                                            <?php } ?>
                                            </h5>
                                            <small class="text-capitalize text-info"><?php echo $row['weight']; ?> kg/kgs</small><br>
                                            <small class="text-capitalize"><?php echo $row['breed']; ?></small><br>
                                            <?php
                                                $birth = new DateTime( $row['DOB'] ); 
                                                $today = new DateTime();
                                                $diff = $today->diff($birth);
                                                $age_y = $diff->y;
                                                $age_m = $diff->m;
                                                $age_d = $diff->d;

                                                echo "<small class='text-muted'>Age: ".$age_y." Years ".$age_m." Months ".$age_m." Days</small>";
                                            ?> 

                                            <form method="post" action="index.php">
                                            <input type="text" name="pig_id" hidden value="<?php echo $row['id']; ?>" class="form-control">
                                            <input type="text" name="user_id" hidden value="<?php echo $row['user_id']; ?>" class="form-control">
                                                <div class="form-group pt-3">
                                                <hr>
                                                <label class="col-md-12" for="example-text">Enter Your Full Name</label>
                                                <input type="text" name="name" class="form-control">
                                                <label class="col-md-12" for="example-text">Enter Your Contact</label>
                                                <input  type="text" 
                                                        id="example-text" 
                                                        name="client_no"
                                                        class="form-control phone-inputmask"
                                                        placeholder="(077)000-0000"
                                                        required >
                                                </div>
                                                <button class="btn btn-info" name="inquire" type="submit">Inquire</button>
                                            </form>
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
                


                <div class="col-md-3 p-4" style="background-color:white; height:88vh;">
                    <h3>Guide : How to Use</h3>
                    <hr>
                    <h3>T&Cs</h3>
                    <hr>
                    <p>

                    </p>
                </div>

            </div>
        
        </section>



    </div>
<?php
    require("../../components/footer.php");
?>