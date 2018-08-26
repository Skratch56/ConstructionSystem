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
        <title>Contract - <?php include('../includes/title.php'); ?></title>
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
                    <a href="dashboard.php" class="navbar-brand hidden-lg"></a>
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
                    <h2 class="pull-left"><i class="fa fa-file-text"></i> Contract</h2>

                    <!-- Breadcrumb -->
                    <div class="bread-crumb pull-right">
                        <a href="dashboard.php"><i class="fa fa-home"></i> Home</a> 
                        <!-- Divider -->
                        <span class="divider">/</span> 
                        <a href="#" class="bread-current">Contract</a>
                        <span class="divider">/</span> 
                        <a href="#" class="bread-current">Contract</a>
                    </div>

                    <div class="clearfix"></div>

                </div>
                <!-- Page heading ends -->



                <!-- Matter -->

                <div class="matter">
                    <?php
                    if (isset($_SESSION['ContractSuccess'])) {
                        echo $_SESSION['ContractSuccess'];
                        $_SESSION['ContractSuccess'] = "";
                    }
                    ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="widget">
                                    <div class="widget-head">
                                        <div class="pull-left"> Contracts
                                            <a href="#addModal" class="btn btn-info" data-toggle="modal">Add New Contract</a>
                                        </div>
                                        <div class="widget-icons pull-right">
                                            <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                                            <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                                        </div>  
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="widget-content">
                                        <div class="padd">

                                            <!-- Table Page -->
                                            <div class="page-tables">
                                                <!-- Table -->
                                                <div class="table-responsive">
                                                    <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th><b>Contract Duration</b></th>
                                                                <th><b>Status</b></th>
                                                                <th><b>Date</b></th>
                                                                <th><b>Customer ID</b></th>
                                                                <th><b>Customer Name</b></th>
                                                                <th><b>Action</b></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            include('../includes/dbcon.php');

                                                            $query = mysqli_query($con, "select * from contract")or die(mysqli_error($con));
                                                            while ($row = mysqli_fetch_array($query)) {
                                                                $id = $row['ContractID'];
                                                                $contracttype = $row['Contract_Type'];
                                                                $Date = $row['Date'];
                                                                $status = $row['status'];
                                                                $custid = $row['Customer_ID'];
                                                                $query2 = mysqli_query($con, "select * from customer where customer_id='$custid'")or die(mysqli_error($con));
                                                                while ($row2 = mysqli_fetch_array($query2)) {
                                                                    $custname = $row2['name'];
                                                                    ?>                      
                                                                    <tr>
                                                                        <td><?php echo $contracttype; ?></td>
                                                                        <td><?php echo $status; ?></td>
                                                                        <td><?php echo $Date; ?></td>
                                                                        <td><?php echo $custid; ?></td>
                                                                        <td><?php echo $custname; ?></td>


                                                                                        <!--                                                                        <td><span class="label label-<?php echo $flag; ?>"><?php echo $status; ?></span></td>-->
                                                                        <td>
                                                                            <?php
                                                                            $query2 = mysqli_query($con, "select * from employee where employee_id=" . $_SESSION['id'])or die(mysqli_error($con));
                                                                            $row2 = mysqli_fetch_array($query2);
                                                                            if ($row2['jobtitle'] == "Admin") {
                                                                                ?>
                                                                                <a href="#myModal" class="btn btn-info" data-target="#update<?php echo $id; ?>" data-toggle="modal">
                                                                                    <i class="fa fa-pencil"></i>
                                                                                </a><?php } else { ?>
                                                                                <a href="#myModal" class="btn btn-info" data-target="#update<?php echo $id; ?>" data-toggle="modal">
                                                                                    <i class="fa fa-pencil"></i>
                                                                                </a>
                                                                                <a class="btn btn-danger" href="#myModal"  data-target="#delete<?php echo $id; ?>" data-toggle="modal">
                                                                                    <i class="fa fa-eraser" title="Delete Record"></i> 
                                                                                </a>

                                                                            <?php } ?>
                                                                        </td>
                                                                    </tr>
                                                                    <!-- Modal -->
                                                                <div id="update<?php echo $id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                <h4 class="modal-title">Update Contract Details</h4>
                                                                            </div>
                                                                            <div class="modal-body" style="height:250px">
                                                                                <!--start form-->
                                                                                <form class="form-horizontal" method="post" action="contract_update.php">
                                                                                    <!-- Title -->
                                                                                    <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-lg-4" for="title">Contract Duration</label>
                                                                                        <div class="col-lg-8"> 
                                                                                            <select name="contracttype"  style="width: 220px" class="select2 form-control" required="required" tabindex="-1" >
                                                                                                <option value="<?php echo $contracttype; ?>"><?php echo $contracttype; ?></option>
                                                                                                <option value="1 Months">1 Months</option>
                                                                                                <option value="3 Months">3 Months</option>
                                                                                                <option value="6 Months">6 Months</option>
                                                                                                <option value="12 Months">12 Months</option>
                                                                                                <option value="18 Months">18 Months</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div> 
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-lg-4" for="password">Status</label>
                                                                                        <div class="col-lg-8"> 

                                                                                            <select name="status"  style="width: 220px" class="select2 form-control" required="required" tabindex="-1" >
                                                                                                <option value="<?php echo $status; ?>"><?php echo $status; ?></option>

                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-lg-4" for="password">Date</label>
                                                                                        <div class="col-lg-8"> 
                                                                                            <input type="date" class="form-control" min="<?php echo date('Y-m-d') ?>" name="date" id="password" placeholder="Write Date" min="<?php echo $Date; ?>" value="<?php echo $Date; ?>">
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Title -->
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-lg-4" for="username">Customer</label>
                                                                                        <div class="col-lg-8"> 
                                                                                            <select name="customerid"  style="width: 220px" class="select2 form-control" required="required" tabindex="-1" >
                                                                                                <?php
                                                                                                mysql_select_db('finalwalk', mysql_connect('localhost', 'root', ''))or die(mysql_error());
                                                                                                $result = mysql_query("select * from customer where customer_id='$custid'") or die(mysql_error());
                                                                                                while ($row = mysql_fetch_array($result)) {
                                                                                                    $id = $row['customer_id'];
                                                                                                    ?>
                                                                                                    <option value="<?php echo $row['customer_id']; ?>"><?php echo $row['customer_id']; ?> - <?php echo $row['name']; ?></option>
                                                                                                <?php } ?>
                                                                                                <?php
                                                                                                mysql_select_db('finalwalk', mysql_connect('localhost', 'root', ''))or die(mysql_error());
                                                                                                $result = mysql_query("select * from customer") or die(mysql_error());
                                                                                                while ($row = mysql_fetch_array($result)) {
                                                                                                    $id = $row['customer_id'];
                                                                                                    ?>
                                                                                                    <option value="<?php echo $row['customer_id']; ?>"><?php echo $row['customer_id']; ?> - <?php echo $row['name']; ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div> 
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-lg-4" for="username">Quotation</label>
                                                                                        <div class="col-lg-8"> 
                                                                                            <select name="quotation"  style="width: 220px" class="select2 form-control" required="required" tabindex="-1" >
                                                                                                <?php
                                                                                                mysql_select_db('finalwalk', mysql_connect('localhost', 'root', ''))or die(mysql_error());
                                                                                                $result = mysql_query("select * from quotation where QuotationID='$custid'") or die(mysql_error());
                                                                                                while ($row = mysql_fetch_array($result)) {
                                                                                                    $id = $row['QuotationID'];
                                                                                                    ?>
                                                                                                    <option value="<?php echo $row['QuotationID']; ?>"><?php echo $row['QuotationID']; ?> - <?php echo $row['Date']; ?></option>
                                                                                                <?php } ?>
                                                                                                <?php
                                                                                                mysql_select_db('finalwalk', mysql_connect('localhost', 'root', ''))or die(mysql_error());
                                                                                                $result = mysql_query("select * from quotation") or die(mysql_error());
                                                                                                while ($row = mysql_fetch_array($result)) {
                                                                                                    $id = $row['quotation_id'];
                                                                                                    ?>
                                                                                                    <option value="<?php echo $row['QuotationID']; ?>"><?php echo $row['QuotationID']; ?> - <?php echo $row['Date']; ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div> 

                                                                                    <!-- Buttons -->
                                                                                    <div class="form-group">
                                                                                        <!-- Buttons -->
                                                                                        <div class="col-lg-offset-4 col-lg-6">
                                                                                            <button type="submit" class="btn btn-sm btn-primary" name="update">Update</button>
                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                                <!--end form-->
                                                                            </div>

                                                                        </div><!--modal content-->
                                                                    </div><!--modal dialog-->
                                                                </div>
                                                                <div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> Contract</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="alert alert-danger">
                                                                                    Are you sure you want to delete?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> No</button>
                                                                                    <a href="combo_save.php?stid=<?php echo $id; ?>" style="margin-bottom:5px;" class="btn btn-primary"><i class="glyphicon glyphicon-ok icon-white"></i> Yes</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end modal-->                      
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        </tbody>
                                                        <tfoot>
                                                        <th><b>Contract Duration</b></th>
                                                        <th><b>Status</b></th>
                                                        <th><b>Date</b></th>
                                                        <th><b>Customer ID</b></th>
                                                        <th><b>Customer Name</b></th>
                                                        <th><b>Action</b></th>


                                                        </tfoot>
                                                    </table>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="widget-foot">
                                        <!-- Footer goes here -->
                                    </div>
                                </div>
                            </div>  

                        </div>
                    </div>
                </div>
            </div>

            <!-- Matter ends -->


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

    <!-- Modal -->
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add New Contract</h4>
                </div>
                <div class="modal-body">
                    <!--start form-->
                    <form class="form-horizontal" method="post" action="contract_save.php">
                        <!-- Title -->
                        <input type="hidden" class="form-control" name="id" >
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="title">Contract Duration</label>
                            <div class="col-lg-8"> 
<!--                                <input type="text" class="form-control" name="contracttype" id="title" placeholder="Write Contract Type" >-->
                                <select name="contracttype" class="select2 form-control" style="width: 220px" required="required" tabindex="-1" >
                                    <option value="">Select Contract Duration</option>
                                    <option value="1 Months">1 Months</option>
                                    <option value="3 Months">3 Months</option>
                                    <option value="6 Months">6 Months</option>
                                    <option value="12 Months">12 Months</option>
                                    <option value="18 Months">18 Months</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="password">Status</label>
                            <div class="col-lg-8"> 
                              
                                <select name="status" class="select2 form-control" required="required" tabindex="-1" >
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="password">Date</label>
                            <div class="col-lg-8"> 
                                <input type="date" class="form-control" min="<?php echo date('Y-m-d') ?>" name="date" id="password" min="" placeholder="Write Date" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="username">Customer</label>
                            <div class="col-lg-8"> 
                                <select name="customerid" class="select2 form-control"  style="width: 220px" required="required" tabindex="-1" >


                                    <?php
                                    if (isset($_GET['custid'])) {
                                        mysql_select_db('finalwalk', mysql_connect('localhost', 'root', ''))or die(mysql_error());
                                        $result = mysql_query("select * from customer where customer_id=" . $_GET['custid']) or die(mysql_error());
                                        while ($row = mysql_fetch_array($result)) {
                                            $id = $row['customer_id'];
                                            ?>
                                            <option value="<?php echo $row['customer_id']; ?>"><?php echo $row['customer_id']; ?> - <?php echo $row['name']; ?></option>
                                            <?php
                                        }
                                    } else {

                                        mysql_select_db('finalwalk', mysql_connect('localhost', 'root', ''))or die(mysql_error());
                                        $result = mysql_query("select * from customer") or die(mysql_error());
                                        ?>
                                        <option value="">Select Customer</option><?php
                                        while ($row = mysql_fetch_array($result)) {
                                            $id = $row['customer_id'];
                                            ?>
                                            <option value="<?php echo $row['customer_id']; ?>"><?php echo $row['customer_id']; ?> - <?php echo $row['name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="username">Quotation</label>
                            <div class="col-lg-8 "> 
                                <select name="quotation" class="select2 form-control "  style="width: 220px" required="required" tabindex="-1" >
                                    <option value="">Select Quotation</option>
                                    <?php
                                    mysql_select_db('finalwalk', mysql_connect('localhost', 'root', ''))or die(mysql_error());
                                    $result = mysql_query("select * from quotation") or die(mysql_error());
                                    while ($row = mysql_fetch_array($result)) {
                                        $id = $row['quotation_id'];
                                        ?>
                                        <option value="<?php echo $row['QuotationID']; ?>"><?php echo $row['QuotationID']; ?> - <?php echo $row['Date']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> 
                        <!-- Buttons -->
                        <div class="col-lg-offset-2 col-lg-6">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                        </div>
                </div>
                </form>
                <!--end form-->
            </div>

        </div><!--modal content-->
    </div><!--modal dialog-->


    <!--end modal-->  
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