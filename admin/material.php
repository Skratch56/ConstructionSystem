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
                    <h2 class="pull-left"><i class="fa fa-user"></i> Material</h2>

                    <!-- Breadcrumb -->
                    <div class="bread-crumb pull-right">
                        <a href="dashboard.php"><i class="fa fa-home"></i> Home</a> 
                        <!-- Divider -->
                        <span class="divider">/</span> 
                        <a href="#" class="bread-current">Material</a>
                        <span class="divider">/</span> 
                        <a href="#" class="bread-current">Material</a>
                    </div>

                    <div class="clearfix"></div>

                </div>
                <!-- Page heading ends -->



                <!-- Matter -->

                <div class="matter"><?php
                    if (isset($_SESSION['MaterialSuccess'])) {
                        echo $_SESSION['MaterialSuccess'];
                        $_SESSION['MaterialSuccess'] = "";
                    }
                    ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="widget">
                                    <div class="widget-head">
                                        <div class="pull-left"> Material
                                            <a href="#addModal" class="btn btn-info" data-toggle="modal">Add New Material</a>
                                        </div>
                                        <a href="printMaterial.php" class="btn btn-info pull-right" >Print Material</a>
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
                                                                <th><b>Type</b></th>
                                                                <th><b>Quantity</b></th>
                                                                <th><b>Description</b></th>
                                                                <th><b>Price</b></th>
                                                                <th><b>Action</b></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            include('../includes/dbcon.php');

                                                            $query = mysqli_query($con, "select * from material order by material_id")or die(mysqli_error($con));
                                                            while ($row = mysqli_fetch_array($query)) {
                                                                $id = $row['material_id'];
                                                                $type = $row['type'];
                                                                $quantity = $row['quantity'];
                                                                $description = $row['description'];
                                                                $price = $row['price'];

                                                                $query4 = mysqli_query($con, "select * from category where Category_ID=" . $type)or die(mysqli_error($con));
                                                                while ($row4 = mysqli_fetch_array($query4)) {
                                                                    $descup = $row4['Description'];
                                                                }
                                                                ?>                      
                                                                <tr>
                                                                    <td><?php echo $descup; ?></td>
                                                                    <td><?php echo $quantity; ?></td>
                                                                    <td><?php echo $description; ?></td>
                                                                    <td><?php echo "R" . $price; ?></td>

                                                                    <td><?php
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
                                                                            <h4 class="modal-title">Update Material Details</h4>
                                                                        </div>
                                                                        <div class="modal-body" style="height:420px">
                                                                            <!--start form-->
                                                                            <form class="form-horizontal" method="post" action="material_update.php">
                                                                                <!-- Title -->
                                                                                <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
                                                                                <div class="form-group">

                                                                                    <label class="control-label col-lg-4" for="Phone Number">Category</label>
                                                                                    <div class="col-lg-8"> 

                                                                                        <select class="form-control" name="type" required="">
                                                                                            <option value="<?php echo $Category_ID; ?>"><?php echo $descup; ?></option>
                                                                                            <?php
                                                                                            mysql_select_db('finalwalk', mysql_connect('localhost', 'root', ''))or die(mysql_error());
                                                                                            $result = mysql_query("select * from category") or die(mysql_error());
                                                                                            while ($row = mysql_fetch_array($result)) {
                                                                                                $catid = $row['Category_ID'];
                                                                                                $des = $row['Description'];
                                                                                                ?>
                                                                                                <option value="<?php echo $catid; ?>"><?php echo $des; ?></option>
                                                                                            <?php } ?>

                                                                                        </select>
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-lg-4" for="title">Quantity</label>
                                                                                    <div class="col-lg-8"> 
                                                                                        <input type="text" class="form-control" name="quantity" onkeyup="numberValidateID(this)" id="title" placeholder="Write Quantity" value="<?php echo $quantity; ?>">
                                                                                    </div>
                                                                                </div> 
                                                                                <!-- Title -->
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-lg-4" for="username">Description</label>
                                                                                    <div class="col-lg-8"> 
                                                                                        <input type="text" class="form-control" name="description"  onkeyup="numberValidateText(this)" id="username" placeholder="Write Description" value="<?php echo $description; ?>">

                                                                                    </div>
                                                                                </div> 
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-lg-4" for="username">Price</label>
                                                                                    <div class="col-lg-8"> 
                                                                                        <input type="text" class="form-control" name="price"  onkeyup="numberValidateID(this)" id="username" placeholder="Write Price" maxlength="10" value="<?php echo $price; ?>">

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
                                                            <div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> Material</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="alert alert-danger">
                                                                                Are you sure you want to delete?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> No</button>
                                                                                <a href="delete-material.php?stid=<?php echo $id; ?>" style="margin-bottom:5px;" class="btn btn-primary"><i class="glyphicon glyphicon-ok icon-white"></i> Yes</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end modal-->                      
                                                        <?php } ?>
                                                        </tbody>
                                                        <tfoot>
                                                        <th><b>Type</b></th>
                                                        <th><b>Quantity</b></th>
                                                        <th><b>Description</b></th>
                                                        <th><b>Price</b></th>
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
                    <h4 class="modal-title">Add New Material</h4>
                </div>
                <div class="modal-body">
                    <!--start form-->
                    <form class="form-horizontal" method="post" action="material_save.php">
                        <!-- Title -->
                        <input type="hidden" class="form-control" name="id" >
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="title">Category</label>
                            <div class="col-lg-8"> 
                                <select class="form-control" name="type" required="">
                                    <option value="">Select Category</option>
                                    <?php
                                    mysql_select_db('finalwalk', mysql_connect('localhost', 'root', ''))or die(mysql_error());
                                    $result = mysql_query("select * from category") or die(mysql_error());
                                    while ($row = mysql_fetch_array($result)) {
                                        $catid = $row['Category_ID'];
                                        $des = $row['Description'];
                                        ?>
                                        <option value="<?php echo $catid; ?>"><?php echo $des; ?></option>
                                    <?php } ?>

                                </select></div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="title">Quantity</label>
                            <div class="col-lg-8"> 
                                <input type="text" class="form-control" name="quantity" onkeyup="numberValidateID(this)" id="title" placeholder="Write Quantity">
                            </div>
                        </div> 
                        <!-- Title -->
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="username">Description</label>
                            <div class="col-lg-8"> 
                                <input type="text" class="form-control" name="description"  onkeyup="numberValidateText(this)" id="username" placeholder="Write Description">

                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="username">Price</label>
                            <div class="col-lg-8"> 
                                <input type="text" class="form-control" name="price"  onkeyup="numberValidateID(this)" maxlength="10" id="username" placeholder="Write Price" >

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