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
        <title>Employee - <?php include('../includes/title.php'); ?></title>
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
                    <h2 class="pull-left"><i class="fa fa-user"></i> Quotations</h2>

                    <!-- Breadcrumb -->
                    <div class="bread-crumb pull-right">
                        <a href="dashboard.php"><i class="fa fa-home"></i> Home</a> 
                        <!-- Divider -->
                        <span class="divider">/</span> 
                        <a href="#" class="bread-current">Maintenance</a>
                        <span class="divider">/</span> 
                        <a href="#" class="bread-current">Quotations</a>
                    </div>

                    <div class="clearfix"></div>

                </div>
                <!-- Page heading ends -->



                <!-- Matter -->

                <div class="matter">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="widget">
                                    <div class="widget-head">
                                        <div class="pull-left"> Quotations
                                            <a href="order.php" class="btn btn-info" >Add New Quotation</a>
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
                                                                <th><b>Date</b></th>
                                                                <th><b>Total Cost</b></th>


                                                                <th><b>Customer ID</b></th>
                                                                <th><b>Employee ID</b></th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            include('../includes/dbcon.php');

                                                            $query = mysqli_query($con, "select * from quotation order by QuotationID")or die(mysqli_error($con));
                                                            while ($row = mysqli_fetch_array($query)) {
                                                                $id = $row['QuotationID'];
                                                                $Date = $row['Date'];
                                                                $Cost = "R".$row['Cost'];
                                                                $CustomerID = $row['CustomerID'];
                                                                $EmployeeID = $row['EmployeeID'];
                                                                ?>                      
                                                                <tr>
                                                                    <td><?php echo $Date; ?></td>
                                                                    <td><?php echo $Cost; ?></td>

                                                                   
                                                                    <td><?php
                                                                        $query3 = mysqli_query($con, "select * from customer where customer_id=" . $CustomerID)or die(mysqli_error($con));

                                                                        while ($row3 = mysqli_fetch_array($query3)) {
                                                                            $custname = $row3['name'];
                                                                            echo $custname;
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td><?php
                                                                        $query2 = mysqli_query($con, "select * from employee where employee_id=" . $EmployeeID)or die(mysqli_error($con));

                                                                        while ($row2 = mysqli_fetch_array($query2)) {
                                                                            $empname = $row2['name'];
                                                                            $empSurname = $row2['surname'];
                                                                            echo $empname . ' ' . $empSurname;
                                                                        }
                                                                        ?>
                                                                    </td>

                                                                </tr>
                                                                <!-- Modal -->
                                                            <div id="update<?php echo $id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                            <h4 class="modal-title">Update Supplier Details</h4>
                                                                        </div>
                                                                        <div class="modal-body" style="height:420px">
                                                                            <!--start form-->
                                                                            <form class="form-horizontal" method="post" action="supplier_update.php">
                                                                                <!-- Title -->
                                                                                <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-lg-4" for="title">Name</label>
                                                                                    <div class="col-lg-8"> 
                                                                                        <input type="text" class="form-control" name="name" onkeyup="numberValidateText(this)" id="title" placeholder="Write Full Name" value="<?php echo $name; ?>">
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-lg-4" for="title">Supplier Type</label>
                                                                                    <div class="col-lg-8"> 
                                                                                        <input type="text" class="form-control" name="suppliertype" onkeyup="numberValidateText(this)" id="title" placeholder="Write Supplier Type" value="<?php echo $Supplier_Type; ?>">
                                                                                    </div>
                                                                                </div> 
                                                                                <!-- Title -->
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-lg-4" for="username">Supplier Number</label>
                                                                                    <div class="col-lg-8"> 
                                                                                        <input type="text" class="form-control" name="suppliernumber" minlength="10" maxlength="10" onkeyup="numberValidateID(this)" id="username" placeholder="Write Supplier Number" value="<?php echo $Supplier_Number; ?>">
                                                                                        <div class="alert alert-info " id="emailstatus2"></div>
                                                                                    </div>
                                                                                </div> 

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
                                                            <!--end modal-->                      
                                                        <?php } ?>
                                                        </tbody>
                                                        <tfoot>
                                                        <th><b>Date</b></th>
                                                        <th><b>Total Cost</b></th>


                                                        <th><b>Customer ID</b></th>
                                                        <th><b>Employee ID</b></th>
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
                    <h4 class="modal-title">Add New Supplier</h4>
                </div>
                <div class="modal-body">
                    <!--start form-->
                    <form class="form-horizontal" method="post" action="supplier_save.php">
                        <!-- Title -->
                        <input type="hidden" class="form-control" name="id" >
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="title">Name</label>
                            <div class="col-lg-8"> 
                                <input type="text" class="form-control" name="name" onkeyup="numberValidateText(this)" id="title" placeholder="Write Full Name" >
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="title">Supplier Type</label>
                            <div class="col-lg-8"> 
                                <input type="text" class="form-control" name="suppliertype" onkeyup="numberValidateText(this)" id="title" placeholder="Write Supplier Type" >
                            </div>
                        </div> 
                        <!-- Title -->
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="username">Supplier Number</label>
                            <div class="col-lg-8"> 
                                <input type="text" class="form-control" minlength="10" maxlength="10" name="suppliernumber" onkeyup="numberValidateID(this)" id="username" placeholder="Write Supplier Number" >

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
</div>
<!--end modal-->  
<!-- JS -->
<script type="text/javascript">
    function numberValidateID(input) {
        var regex = /[^0-9]/g;
        var input1 = input.value;


        if (input1.match(regex)) {
            input.value = input.value.replace(regex, "");

            swal("Oops!", "This field must only contain numbers!", "error");
        }

    }
    function email_validate(email)
    {
        var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

        if (regMail.test(email) === false)
        {
            document.getElementById("emailstatus").innerHTML = "<span class='warning'>This is not a valid email.</span>";
            document.getElementById("emailstatus2").innerHTML = "<span class='warning'>This is not a valid email.</span>";
        } else
        {
            document.getElementById("emailstatus").innerHTML = "<span class='valid'>Your email is valid!</span>";
            document.getElementById("emailstatus2").innerHTML = "<span class='valid'>Your email is valid!</span>";
        }
    }
</script>
<script type="text/javascript">
    function numberValidateText(input) {

        var regex = /[^a-zA-Z -]+/;
        var input1 = input.value;


        if (input1.match(regex)) {
            input.value = input.value.replace(regex, "");
            swal("Oops!", "This field must only contain text!", "error");


        }
    }
</script>
<script type="text/javascript">
    function passwordValidate(input) {
        var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,}$/;


        if (regex.test(input) === false)
        {
            document.getElementById("Messagepass").innerHTML = "<span class='warning'>Password is not strong yet.</span>";
        } else
        {
            document.getElementById("Messagepass").innerHTML = "<span class='valid'>Thanks, you have entered a valid Password!</span>";
        }
    }
</script>
<?php include('../includes/js.php'); ?>  

</body>
</html>