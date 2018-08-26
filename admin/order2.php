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
        <title>Quotation - <?php include('../includes/title.php'); ?></title>
        <?php include('../includes/links.php'); ?>

    </head>

    <body>

        <div class="navbar navbar-fixed-top bs-docs-nav" role="banner">

            <div class="conjtainer">
                <!-- Menu button for smallar screens -->
                <div class="navbar-header">
                    <button class="navbar-toggle btn-navbar" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                        <span>Quote A Service</span>
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
                    <h2 class="pull-left"><i class="fa fa-money"></i> Quotations

                    </h2>

                    <!-- Breadcrumb -->
                    <div class="bread-crumb pull-right">
                        <a href="dashboard.php"><i class="fa fa-home"></i> Home</a> 
                        <!-- Divider -->
                        <span class="divider">/</span> 
                        <a href="#" class="bread-current">Quotations</a>
 <span class="divider">/</span> 
  <a href="#" class="bread-current">Quote A Service</a>
                    </div>

                    <div class="clearfix"></div>

                </div>
                <!-- Page heading ends -->



                <!-- Matter -->

                <div class="matter"><?php
                    if (isset($_SESSION['QuotationSuccess'])) {
                        echo $_SESSION['QuotationSuccess'];
                        $_SESSION['QuotationSuccess'] = "";
                    }
                    ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2><i class="fa fa-plus"></i> Quotation</h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>

                                                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <!-- content starts here -->

                                                <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">

                                                    
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4" for="last-name">QuotationID<span class="required" style="color:red;">*</span>
                                                        </label>
                                                        <div class="col-md-5">
                                                            <select name="quotationid" class="select2_single form-control" required="required" tabindex="-1" >
                                                                <option value="">Select Quotation</option>
                                                                <?php
                                                                mysql_select_db('finalwalk', mysql_connect('localhost', 'root', ''))or die(mysql_error());
                                                                $result = mysql_query("select * from quotation") or die(mysql_error());
                                                                while ($row = mysql_fetch_array($result)) {
                                                                    $id = $row['QuotationID'];
                                                                    $id2 = $row['CustomerID'];
                                                                    $result2 = mysql_query("select * from customer where customer_id=" . $id2) or die(mysql_error());
                                                                    while ($row2 = mysql_fetch_array($result2)) {
                                                                        ?>
                                                                        <option value="<?php echo $row['QuotationID']; ?>"><?php echo $row['QuotationID']; ?> - Name:<?php echo $row2['name']; ?> Date:<?php echo $row['Date']; ?></option>
                                                                    <?php }
                                                                }
                                                                ?>
                                                                        <option value="0">Quick Qoutation</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    




                                                    <div class="form-group">
                                                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                                            <a href="dashboard.php"><button type="button" class="btn btn-primary"><i class="fa fa-times-circle-o"></i> Cancel</button></a>
                                                            <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-plus-square"></i> Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <?php
                                            include ('../includes/dbcon.php');
                                            if (!isset($_POST['submit'])) {
                                                
                                            } else {
                                                mysql_select_db('finalwalk', mysql_connect('localhost', 'root', ''))or die(mysql_error());


                                               
                                                $quotationid = $_POST['quotationid'];
  
                                                echo "<script> window.location='service.php?qid=".$quotationid."'</script>";
                                            }
                                            ?>

                                            <!-- content ends here -->
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


                            <!-- JS -->
<?php include('../includes/js.php'); ?>  
                            <script>
                                $(function () {
                                    //Initialize Select2 Elements
                                    $(".select2").select2();

                                })
                            </script>
                            </body>
                            </html>