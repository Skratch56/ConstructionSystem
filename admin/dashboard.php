<?php
session_start();
if (empty($_SESSION['id'])):
    header('Location:index.php');
endif;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <!-- Title and other stuffs -->
        <title>Home - <?php include('../includes/title.php'); ?></title>
        <?php include('../includes/links.php'); ?>

    </head>

    <body>

        <div class="navbar navbar-fixed-top bs-docs-nav" role="banner">

            <div class="conjtainer">
                <!-- Menu button for smallar screens -->
                <div class="navbar-header">
                    <button class="navbar-toggle btn-navbar" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                        <span>Menu</span>
                    </button>
                    <!-- Site name for smallar screens -->
                    <a href="dashboard.php" class="navbar-brand hidden-lg">Final Walk</a>
                </div>

                <?php include('../includes/topbar.php'); ?>


            </div>
        </div>



        <!-- Main content starts -->

        <div class="content" style="margin-top:10px">

            <!-- Sidebar -->
            <?php include('../includes/sidebar.php'); ?>

            <!-- Sidebar ends -->

            <!-- Main bar -->
            <div class="mainbar">

                <!-- Page heading -->
                <div class="page-head">
                    <h1 class="pull-left"><i class="fa fa-home"></i> Home</h1>

                    <!-- Breadcrumb -->
                    <div class="bread-crumb pull-right">
                        <a href="dashboard.php"><i class="fa fa-home"></i> Home</a> 
                        <!-- Divider -->
                        <span class="divider">/</span> 
                        <a href="#" class="bread-current">Contracts</a>
                        <span class="divider">/</span> 
                        <a href="#" class="bread-current">View Details</a>
                    </div>

                    <div class="clearfix"></div>

                </div>
                <!-- Page heading ends -->



                <!-- Matter -->

                <div class="matter">
                    <div class="container">
                        <div class="row" >
                            <?php
                            include('../includes/dbcon.php');
                            $today = date('Y-m-d');
                            $query = mysqli_query($con, "select COUNT(*) as count from contract where status='Approved'")or die(mysqli_error($con));
                            $row = mysqli_fetch_array($query);
                            $count = $row['count'];
                            ?>             
                            <a href="quotations.php"><div class="col-md-4" href="contract.php">
                                    <div class="alert alert-info">
                                        <i class="fa fa-wrench pull-left" style="font-size:65px"></i><h2> <?php echo $count; ?> </h2>
                                        <p  >Approved</p>
                                    </div>
                                </div></a><!--
                            -->                            <?php
                            $query = mysqli_query($con, "select COUNT(*) as count from contract where status='Pending'")or die(mysqli_error($con));
                            $row = mysqli_fetch_array($query);
                            $count = $row['count'];
                            ?> 
                            <a href="contract.php"><div class="col-md-4">
                                    <div class="alert alert-warning">
                                        <i class="fa fa-calendar pull-left" style="font-size:65px"></i><h2 class=""><?php echo $count; ?></h2>
                                        <p>Pending</p>                        
                                    </div>
                                </div></a><!--
                            -->                            <?php
                            $query = mysqli_query($con, "select COUNT(*) as count from contract where status='Finished'")or die(mysqli_error($con));
                            $row = mysqli_fetch_array($query);
                            $count = $row['count'];
                            ?> 
                            <a href="contract.php"><div class="col-md-4">
                                    <div class="alert alert-success">
                                        <i class="fa fa-credit-card pull-left" style="font-size:65px"></i><h2><?php echo $count; ?></h2>
                                        <p>Finished</p>
                                    </div>
                                </div></a></div></div></div>
                <div class="matter">
                    <div class="container">
                        <div class="row">
                            <?php
                            include('../includes/dbcon.php');
                            $today = date('Y-m-d');
                            $query = mysqli_query($con, "select COUNT(*) as count from customer")or die(mysqli_error($con));
                            $row = mysqli_fetch_array($query);
                            $count = $row['count'];
                            ?>             
                            <a href="members.php"><div class="col-md-4">
                                    <div class="alert alert-info">
                                        <i class="fa fa-users pull-left" style="font-size:65px"></i><h2> <?php echo $count; ?> </h2>
                                        <p>Customers</p>
                                    </div>
                                </div></a><!--
                            -->                            <?php
                            $query = mysqli_query($con, "select COUNT(*) as count from employee")or die(mysqli_error($con));
                            $row = mysqli_fetch_array($query);
                            $count = $row['count'];
                            ?> 
                            <a href="employees.php"><div class="col-md-4">
                                    <div class="alert alert-warning">
                                        <i class="fa fa-user-md pull-left" style="font-size:65px"></i><h2 class=""><?php echo $count; ?></h2>
                                        <p>Employees</p>                        
                                    </div>
                                </div></a><!--
                            -->                            <?php
                            $query = mysqli_query($con, "select COUNT(*) as count from supplier")or die(mysqli_error($con));
                            $row = mysqli_fetch_array($query);
                            $count = $row['count'];
                            ?> 
                            <a href="supplier.php"><div class="col-md-4">
                                    <div class="alert alert-success">
                                        <i class="fa fa-user pull-left" style="font-size:65px"></i><h2><?php echo $count; ?></h2>
                                        <p>Supplier</p>
                                    </div>
                                </div></a></div></div></div>
                <div class="matter">
                    <div class="container">
                        <div class="row">
                            <?php
                            include('../includes/dbcon.php');
                            $today = date('Y-m-d');
                            $query = mysqli_query($con, "select COUNT(*) as count from service")or die(mysqli_error($con));
                            $row = mysqli_fetch_array($query);
                            $count = $row['count'];
                            ?>             
                            <a href="combo.php"><div class="col-md-4">
                                    <div class="alert alert-info">
                                        <i class="fa fa-gears pull-left" style="font-size:65px"></i><h2> <?php echo $count; ?> </h2>
                                        <p>Services</p>
                                    </div>
                                </div></a><!--
                            -->                            <?php
                            $query = mysqli_query($con, "select COUNT(*) as count from material")or die(mysqli_error($con));
                            $row = mysqli_fetch_array($query);
                            $count = $row['count'];
                            ?> 
                            <a href="material.php"><div class="col-md-4">
                                    <div class="alert alert-warning">
                                        <i class="fa fa-gear pull-left" style="font-size:65px"></i><h2 class=""><?php echo $count; ?></h2>
                                        <p>Material</p>                        
                                    </div>
                                </div></a>
                        </div></div></div>
                <div  style="width: 900px;height:300px;  margin: 0 auto; overflow-x:scroll;">

                    <?php
                    include('../includes/dbcon.php');

                    $query8 = mysqli_query($con, "select * from quotation order by QuotationID")or die(mysqli_error($con));
                    while ($row = mysqli_fetch_array($query8)) {
                        $id = $row['QuotationID'];
                        $Date = $row['Date'];
                        $Cost = "R" . $row['Cost'];
                        $CustomerID = $row['CustomerID'];
                        $EmployeeID = $row['EmployeeID'];
                        $query3 = mysqli_query($con, "select * from customer where customer_id=" . $CustomerID)or die(mysqli_error($con));
                        while ($row3 = mysqli_fetch_array($query3)) {
                            $custname = $row3['name'];
                        }
                        $query2 = mysqli_query($con, "select * from employee where employee_id=" . $EmployeeID)or die(mysqli_error($con));

                        while ($row2 = mysqli_fetch_array($query2)) {
                            $empname = $row2['name'];
                            $empSurname = $row2['surname'];
                        }
                        ?><div  style="width: 800px; ">
                            <div class="modal-content">
                                <!-- lockscreen image -->
                                <div class="lockscreen-image">
                                    <img src="../img/investigations.png" alt="User Image">
                                </div>


                                <br><br><br>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class='col-md-2 padding-top-5'style="  margin-left: 50px">
                                            <label class="control-label" for="username">QuotationID: </label>
                                            <label class="control-label" for="username"><?php echo $id; ?></label>
                                        </div> 
                                        <div class='col-md-3 padding-top-5'>
                                            <label class="control-label" for="username">Quotation Date: </label>
                                            <label class="control-label" for="username"><?php echo $Date; ?></label>
                                        </div> 
                                        <div class='col-md-3 padding-top-5'>
                                            <label class="control-label" for="username">Quotation Date: </label>
                                            <label class="control-label" for="username"><?php echo $Date; ?></label>
                                        </div> 
                                        <div class='col-md-3 padding-top-5'>
                                            <label class="control-label" for="username">Quotation Cost: </label>
                                            <label class="control-label" for="username"><?php echo $Cost; ?></label>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class='col-md-3 padding-top-5'style="  margin-left: 50px">
                                            <label class="control-label" for="password">Customer Name: </label>
                                            <label class="control-label" for="username"><?php echo $custname; ?></label>
                                        </div> 
                                        <div class='col-md-4 padding-top-5'>
                                            <label class="control-label" for="password">Employee Name: </label>
                                            <label class="control-label" for="username"><?php echo $empname . " " . $empSurname; ?></label>
                                        </div> 
                                    </div>



                                </div>



                            </div>
                        </div><br>
                        <br><br>
                    <?php } ?>
                    <!-- /.lockscreen credentials -->

                </div>





            </div>

            <!-- Mainbar ends -->
            <div class="clearfix"></div>

        </div>
        <!-- Content ends -->

        <!-- Footer starts -->
        <?php include('../includes/footer.php'); ?>  

        <!-- Footer ends -->

        <!-- Scroll to top -->
        <span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 
        <script type="text/javascript">
            function ready() {
                swal("Welcome", "Welcome to Khomanani Constructions!", "success");

            }
        </script>
        <?php include('../includes/js.php'); ?>  
        <?php
        if ($_SESSION['welcome'] == 0) {
            echo '<script type="text/javascript">',
            'ready();',
            '</script>'
            ;
            $_SESSION['welcome'] = 1;
        }
        ?>


    </body>
</html>