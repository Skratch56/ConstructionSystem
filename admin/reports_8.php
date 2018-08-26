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
                        <span>Reports</span>
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
                    <h1 class="pull-left"><i class="fa fa-file-text"></i> Reports</h1>

                    <!-- Breadcrumb -->
                    <div class="bread-crumb pull-right">
                        <a href="dashboard.php"><i class="fa fa-home"></i> Home</a> 
                        <!-- Divider -->
                        <span class="divider">/</span> 
                        <a href="#" class="bread-current">Reports</a>
                        <span class="divider">/</span> 
                        <a href="#" class="bread-current">Reports</a>
                    </div>

                    <div class="clearfix"></div>

                </div>  
                <div class="matter">
                    <div class="container">

                        <div class="row">
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2><i class="fa fa-plus"></i> Reports</h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>

                                                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="row">
                                                <div class="x_content">

                                                    <form action="reporting/quotation_report.php" class="form-horizontal form-label-left" method="post">
                                                        <div class="col-md-1 padding-top-10">
                                                            <b><font color="#00bfff">Quotation</font></b>      
                                                        </div>



                                                        <!-- Filtering dates -->
                                                        <div class="col-md-1">
                                                            <label>From</label>
                                                            <?php
                                                            date_default_timezone_set("Africa/Johannesburg");
                                                            echo '<input type="date" style="width: 160px" class="form-control" name="quotation_from_date" id="quotation_from_date" max="' . date('Y-m-d') . '" value="" onchange="" />';
                                                            ?>
                                                        </div>

                                                        <div class="col-md-1">
                                                            &nbsp
                                                        </div>

                                                        <div class="col-md-1">
                                                            <label>To</label>
                                                            <?php
                                                            date_default_timezone_set("Africa/Johannesburg");
                                                            echo '<input type="date" style="width: 160px" class="form-control" name="quotation_to_date" id="quotation_to_date" max="' . date('Y-m-d') . '" value="" onchange="checkBookingDates(\'booking_from_date\',\'booking_to_date\')" />';
                                                            ?>
                                                        </div>



                                                        <div class="col-md-1">
                                                            &nbsp
                                                        </div>

                                                        <div class="col-md-1 padding-top-10">
                                                            <input class="form-control btn-info" type="submit" value="View" style="width:60px; margin-top:15px" />   
                                                        </div>
                                                    </form>

                                                </div></div>
                                            <div class="row">
                                                <div class="x_content">

                                                    <form action="reporting/contract_report.php" class="form-horizontal form-label-left" method="post">
                                                        <div class="col-md-1 padding-top-10">
                                                            <b><font color="#00bfff">Contract</font></b>      
                                                        </div>



                                                        <!-- Filtering dates -->
                                                        <div class="col-md-1">
                                                            <label>From</label>
                                                            <?php
                                                            date_default_timezone_set("Africa/Johannesburg");
                                                            echo '<input type="date" style="width: 160px" class="form-control" name="quotation_from_date" id="quotation_from_date" max="' . date('Y-m-d') . '" value="" onchange="" />';
                                                            ?>
                                                        </div>

                                                        <div class="col-md-1">
                                                            &nbsp
                                                        </div>

                                                        <div class="col-md-1">
                                                            <label>To</label>
                                                            <?php
                                                            date_default_timezone_set("Africa/Johannesburg");
                                                            echo '<input type="date" style="width: 160px" class="form-control" name="quotation_to_date" id="quotation_to_date" max="' . date('Y-m-d') . '" value="" onchange="checkBookingDates(\'booking_from_date\',\'booking_to_date\')" />';
                                                            ?>
                                                        </div>



                                                        <div class="col-md-1">
                                                            &nbsp
                                                        </div>

                                                        <div class="col-md-1 padding-top-10">
                                                            <input class="form-control btn-info" type="submit" value="View" style="width:60px; margin-top:15px" />   
                                                        </div>
                                                    </form>

                                                </div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

        <?php include('../includes/js.php'); ?>  


    </body>
</html>