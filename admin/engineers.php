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
        <title>Engineer - <?php include('../includes/title.php'); ?></title>
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
                    <a href="index.html" class="navbar-brand hidden-lg"></a>
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
                    <h2 class="pull-left"><i class="fa fa-home"></i> Dashboard</h2>

                    <!-- Breadcrumb -->
                    <div class="bread-crumb pull-right">
                        <a href="index.html"><i class="fa fa-home"></i> Home</a> 
                        <!-- Divider -->
                        <span class="divider">/</span> 
                        <a href="#" class="bread-current">Maintenance</a>
                        <span class="divider">/</span> 
                        <a href="#" class="bread-current">Engineer</a>
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
                                        <div class="pull-left"> Users
                                            <a href="#addModal" class="btn btn-info" data-toggle="modal">Add New Engineer</a>
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
                                                                <th>Name</th>
                                                                <th>City</th>
                                                                <th>Email</th>
                                                                <th>Phone Number</th>
                                                                <th>Field Type</th>
                                                                <th>Postal Code</th>

                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            include('../includes/dbcon.php');

                                                            $query = mysqli_query($con, "select * from engineer order by name")or die(mysqli_error($con));
                                                            while ($row = mysqli_fetch_array($query)) {
                                                                $id = $row['Engineer_ID'];
                                                                $name = $row['Name'];
                                                                $city = $row['City'];
                                                                ;
                                                                $email = $row['Email'];
                                                                $phonenumber = $row['Phone_Number'];

                                                                $fieldtype = $row['Field_type'];
                                                                $postalcode = $row['Postal_code'];
                                                                ?>                      
                                                                <tr>
                                                                    <td><?php echo $name; ?></td>
                                                                    <td><?php echo $city; ?></td>
                                                                    <td><?php echo $email; ?></td>
                                                                    <td><?php echo $phonenumber; ?></td>
                                                                    <td><?php echo $fieldtype; ?></td>
                                                                    <td><?php echo $postalcode; ?></td>

<!--                                                                    <td><span class="label label-<?php echo $flag; ?>"><?php echo $status; ?></span></td>-->
                                                                    <td>
                                                                        <a href="#myModal" class="btn btn-info" data-target="#update<?php echo $id; ?>" data-toggle="modal">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <!-- Modal -->
                                                            <div id="update<?php echo $id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                            <h4 class="modal-title">Update Engineer Details</h4>
                                                                        </div>
                                                                        <div class="modal-body" style="height:250px">
                                                                            <!--start form-->
                                                                            <form class="form-horizontal" method="post" action="engineer_update.php">
                                                                                <!-- Title -->
                                                                                <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-lg-4" for="title">Name</label>
                                                                                    <div class="col-lg-8"> 
                                                                                        <input type="text" class="form-control" name="name" id="title" placeholder="Write Full Name" value="<?php echo $name; ?>">
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-lg-4" for="password">City</label>
                                                                                    <div class="col-lg-8"> 
                                                                                        <input type="text" class="form-control" name="city" id="password" placeholder="Write City" value="<?php echo $city; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Title -->
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-lg-4" for="username">Email</label>
                                                                                    <div class="col-lg-8"> 
                                                                                        <input type="text" class="form-control" name="email" id="username" placeholder="Write Email Address" value="<?php echo $email; ?>">
                                                                                    </div>
                                                                                </div> 
                                                                                <!-- Title -->
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-lg-4" for="Phone Number">Phone Number</label>
                                                                                    <div class="col-lg-8"> 
                                                                                        <input class="form-control" name="phonenumber" id="password" placeholder="Write Phone Number" value="<?php echo $phonenumber; ?>">
                                                                                    </div>
                                                                                </div>  
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-lg-4" for="Phone Number">Field Type</label>
                                                                                    <div class="col-lg-8"> 
                                                                                        <input class="form-control" name="fieldtype" id="password" placeholder="Write Field Type Number" value="<?php echo $fieldtype; ?>">
                                                                                    </div>
                                                                                </div> 
                                                                                <!-- Title -->
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-lg-4" for="password">Postal Code</label>
                                                                                    <div class="col-lg-8"> 
                                                                                        <input class="form-control" name="postalcode" id="password" placeholder="Write Postal Code" value="<?php echo $postalcode; ?>">
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
                                                            <!--end modal-->                      
                                                        <?php } ?>
                                                        </tbody>
                                                        <tfoot>
                                                        <th>Name</th>
                                                        <th>City</th>
                                                        <th>Email</th>
                                                        <th>Phone Number</th>
                                                        <th>Field Type</th>
                                                        <th>Postal Code</th>

                                                        <th>Action</th>
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
                    <h4 class="modal-title">Add New Engineer</h4>
                </div>
                <div class="modal-body">
                    <!--start form-->
                    <form class="form-horizontal" method="post" action="engineer_save.php">
                        <!-- Title -->
                        <input type="hidden" class="form-control" name="id" >
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="title">Name</label>
                            <div class="col-lg-8"> 
                                <input type="text" class="form-control" name="name" id="title" placeholder="Write Full Name" >
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="password">City</label>
                            <div class="col-lg-8"> 
                                <input type="text" class="form-control" name="city" id="password" placeholder="Write City" >
                            </div>
                        </div>
                        <!-- Title -->
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="username">Email</label>
                            <div class="col-lg-8"> 
                                <input type="text" class="form-control" name="email" id="username" placeholder="Write Email Address" >
                            </div>
                        </div> 
                        <!-- Title -->
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="Phone Number">Phone Number</label>
                            <div class="col-lg-8"> 
                                <input class="form-control" name="phonenumber" id="password" placeholder="Write Phone Number" >
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="Phone Number">Field Type</label>
                            <div class="col-lg-8"> 
                                <input class="form-control" name="fieldtype" id="password" placeholder="Write Field Type" >
                            </div>
                        </div> 
                        <!-- Title -->
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="password">Postal Code</label>
                            <div class="col-lg-8"> 
                                <input class="form-control" name="postalcode" id="password" placeholder="Write Postal Code" >
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
<?php include('../includes/js.php'); ?>  

</body>
</html>