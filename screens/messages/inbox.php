<?php 
$page_title = "Inbox"; 
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
                        <h4 class="text-themecolor">Inbox</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Inbox</li>
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
                        if(isset($_POST['delete']))
                        {
                            $id = $_POST['expense_id'];
                            $query = mysqli_query($conn,"DELETE FROM inbox WHERE id = $id ");
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
                    ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">All Messages</h5>
                                <hr>
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>From</th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                                <th>Sent On</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $user_id = $_SESSION['id'];
                                            $query_ = mysqli_query($conn,"SELECT * FROM inbox WHERE `toUser`='$user_id' ORDER BY dateSent DESC ");
                                            if(mysqli_num_rows($query_)>0){
                                                $x=1;
                                                while($row = mysqli_fetch_array($query_)){
                                        ?>
                                            <tr>
                                                <td><?php echo $x++; ?></td>
                                                <td><?php echo $row['fromUser']; ?></td>
                                                <td><?php echo $row['subject']; ?></td>                                        
                                                <td><?php echo $row['message']; ?></td>
                                                <td><?php echo $row['dateSent']; ?></td>
                                                <td>
                                                    <form method="post" action="inbox.php">
                                                        <input hidden name="expense_id" value="<?php echo $row['id'] ?>">
                                                        <div class="row pt-2 pb-1 px-2">
                                                            <button  type="submit" onclick="return confirm('Are you sure you want to delete this message ?')" name="delete" class="py-1 btn btn-danger d-none d-lg-block m-l-15">Delete</button>
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