<?php 
include("../../config.php");
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="http://eliteadmin.themedesigner.in/demos/bt4/assets/images/favicon.png"> -->
    <title><?php echo $SYS_NAME; ?> - Register</title>
    
    <!-- page css -->
    <link href="../../dist/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../dist/css/style.min.css" rel="stylesheet">
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="skin-default card-no-border">
    <?php
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['conpassword'];
            $hash = sha1($password);
            
            if($password == $cpassword){
                $q = mysqli_query($conn,"SELECT * FROM `users` WHERE `email` = '$email' LIMIT 1 ");
                $count = mysqli_num_rows($q);
                if($count == 0){
                    $qry = mysqli_query($conn,"INSERT INTO `users`(`id`, `name`, `email`, `password`, `role`, `online`) VALUES (null,'$name','$email','$hash',1,0)");
                    if($qry){
                        $success = 'User registered successfully';
                    }else{
                        $error = 'Error occured while registering user. Please try again';
                    }
                } else { 
                    $error = 'User with email address: '.$email.' already exists !';
                }
            } else{
                $error = 'Passwords do not match. Please try again';
            }                
        }

    ?>
    

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <?php include("../../components/loader.php"); ?>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    

    <section id="wrapper">
        <div class="login-register" style="background-image:url(../assets/images/background/login-register.jpg);">
            <div class="login-box">
            <?php   
                if(isset($error)){ ?>
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong><?php echo $error; ?>.</strong>
                    </div>
            <?php } ?>
            <?php   
                if(isset($success)){ ?>
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong><?php echo $success; ?>.</strong>
                    </div>
            <?php } ?>
            </div>
            <div class="login-box card">       
                <div class="card-body">
                    
                    <form class="form-horizontal form-material" id="loginform" action="register.php" method="post">
                        <div class="text-center pt-4">
                            <img src="../../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                        </div>    
                        <h1 class="text-center m-b-20 pb-4 pt-2 px-4" style="font-weight: bold;"><b><?php echo $SYS_NAME; ?></b></h1>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Full name" name="name"> </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="email" required="" placeholder="Email" name="email"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" placeholder="Password" name="password"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" placeholder="Confirm Password" name="conpassword"> </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit" name="submit">Register</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <a href="../home/index.php"> Back Home</a>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="index.php"> Login</a>
                            </div>
                        </div>
                    </form>
                    <!-- <form class="form-horizontal" id="recoverform" action="index.html">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Email"> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                            </div>
                        </div>
                    </form> -->
                </div>
                
            </div>
            
        </div>
    </section>
    
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../../assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/node_modules/popper/popper.min.js"></script>
    <script src="../../assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>
    
</body>

</html>