<?php
session_start();
if (empty($_SESSION['id'])):
    header('Location:index.php');
endif;

$_SESSION['quotation_no'] = $_GET['qid'];
include('../includes/dbcon.php');
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
                    <h2 class="pull-left"><i class="fa fa-gears"></i> Services</h2>

                    <!-- Breadcrumb -->
                    <div class="bread-crumb pull-right">
                        <a href="dashboard.php"><i class="fa fa-home"></i> Home</a> 
                        <!-- Divider -->
                        <span class="divider">/</span> 
                        <a href="#" class="bread-current">Service</a>
                        <span class="divider">/</span> 
                        <a href="#" class="bread-current">Service</a>
                    </div>

                    <div class="clearfix"></div>

                </div>

                <div class="container">
                    <div class="panel panel-default">
                       
                        <div class="panel-body">

                            <!-- Start of search form -->
                           

                              


                                    <div class="panel panel-default">
                                        <div class="panel-heading">Service Details</div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-2 padding-top-5" align="right">
                                                    Total Amount:
                                                </div>

                                                <div class="col-md-2">
                                                    <?php
                                                    $TotAmount = 0;



                                                    $query4 = "SELECT * from `quote/service` WHERE QuotationID = " . $_GET['qid'] . "";
                                                    $result6 = mysqli_query($con, $query4);

                                                    while ($rows4 = mysqli_fetch_array($result6)) {

                                                        $part_No = $rows4['ServiceID'];
                                                        $query5 = "SELECT * from service WHERE ServiceID ='$part_No'";
                                                        $result5 = mysqli_query($con, $query5);
                                                        while ($rows5 = mysqli_fetch_array($result5)) {
                                                            $sellingprice = $rows5['Cost'];
                                                            $TotAmount += $sellingprice;
                                                        }
                                                    }

                                                    $query11 = "Update quotation set Cost='$TotAmount' where QuotationID=" . $_GET['qid'] . "";
                                                    $result11 = mysqli_query($con, $query11);
                                                    echo '<input type="text" class="form-control" name="servicedesc1" id="servicedesc1" value="' . 'R' . $TotAmount . '" readonly />';


                                                    echo "<script>document.getElementById('btnnext').disabled = false;</script>"
                                                    ?>
                                                </div>

                                                <div class="col-md-1 padding-top-5" align="right">
                                                    Customer #
                                                </div>

                                                <div class="col-md-2">
                                                    <?php
                                                    $query2 = "SELECT * from quotation WHERE QuotationID = " . $_GET['qid'] . "";
                                                    $result2 = mysqli_query($con, $query2);

                                                    while ($rows2 = mysqli_fetch_array($result2)) {
                                                        $booking_id = $rows2['CustomerID'];
                                                    }


                                                    $query4 = "SELECT * from customer WHERE customer_id = " . $booking_id . "";
                                                    $result4 = mysqli_query($con, $query4);

                                                    while ($rows4 = mysqli_fetch_array($result4)) {
                                                        $customer_fname = $rows4['name'];
                                                    }


                                                    echo '<input type="text" class="form-control" name="servicerate1" id="servicerate1" value="' . $booking_id . ' ' . $customer_fname . '" readonly />';
                                                    ?>
                                                </div>

                                            </div>

                                            <br>
                                            <div class="row">


                                                <div class="col-md-2 padding-top-5" align="right">
                                                    Employee #
                                                </div>

                                                <div class="col-md-2">
                                                    <?php
                                                    $query2 = "SELECT * from quotation WHERE QuotationID = " . $_GET['qid'] . "";
                                                    $result2 = mysqli_query($con, $query2);
                                                    while ($rows2 = mysqli_fetch_array($result2)) {
                                                        $booking_id = $rows2['EmployeeID'];
                                                    }

                                                    $query4 = "SELECT * from employee WHERE employee_id =" . $booking_id . "";
                                                    $result4 = mysqli_query($con, $query4);

                                                    while ($rows4 = mysqli_fetch_array($result4)) {
                                                        $customer_fname = $rows4['name'];
                                                        $customer_sname = $rows4['surname'];
                                                    }


                                                    echo '<input type="text" class="form-control" name="servicerate1" id="servicerate1" value="' . $booking_id . ' ' . $customer_fname . '" readonly />';
                                                    ?>
                                                </div>
                                                <div class="col-md-2 padding-top-5"></div>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2 padding-top-10" align="right">
                                            Details:
                                        </div>

                                        <div class="col-md-2 padding-top-10">
                                            <?php
                                            $query2 = "SELECT * from `quote/service` WHERE QuotationID = '" . $_GET['qid'] . "'";
                                            $result2 = mysqli_query($con, $query2);

                                            while ($rows2 = mysqli_fetch_array($result2)) {

                                                $service_id = $rows2['ServiceID'];




                                                $sql = "SELECT * from service WHERE ServiceID = '" . $service_id . "'";

                                                $i = 0;
                                                $previousArtistID = "";
                                                $result = mysqli_query($con, $sql);
                                                while ($row = mysqli_fetch_array($result)) { // loop through your database
                                                    if ($row['ServiceID'] != $previousArtistID) { // if the current artist is not the previous
                                                        if ($i > 0) {
                                                            echo "</table>"; // if the artist is not the first, close the previous table
                                                            echo "<hr>"; // for demo
                                                        }
                                                        echo '<div class="page-tables">';

                                                        echo '<div class="table-responsive">';
                                                        echo '<table cellpadding="1" cellspacing="1" border="1" id="data-table" width="100%">'; // start a table, with headers
                                                        echo "<tr>";
                                                        echo "<th>Service_ID</th>";
                                                        echo "<th>Description</th>";
                                                        echo "<th>Cost</th>";

                                                        echo "</tr>";
                                                        echo "<tr>";

                                                        echo "</tr>";
                                                        $i++; // increment counter
                                                        $previousArtistID = $row['ServiceID']; // set the previousArtistID to the current artistID
                                                    }
                                                    // list all songs
                                                    echo "<tr>";
                                                    echo "<td>" . $row['ServiceID'] . "</td>";
                                                    echo "<td>" . $row['ServiceType'] . "</td>";
                                                    echo "<td>" . 'R' . $row['Cost'] . "</td>";

                                                    echo "</tr>";
                                                }
                                                echo "</table>";
                                                echo "</div>";
                                                echo "</div>"; // close the table
                                            }
                                            ?>
                                        </div>


                                        <div class="col-md-4 padding-top-5"></div>
                                    </div>

                                    <br>
                                    <a href="printQuotationInvoice.php?qid=<?php echo $_GET['qid'] ?>" class="btn btn-info pull-right" >Print Quotation</a>
                                    <div class="row padding-top-10">



                                        <!--                                                <div class="col-md-2 padding-top-10">
                                                                                            <button type="button" name="btnnext" id="btnnext" class="btn btn-info" onclick="getJobPage()" style="width:160px"> Next </button>
                                                                                        </div>
                                                                                        <div class="col-md-1 padding-top-10">
                                                                                        </div>
                                        
                                                                                        <div class="col-md-2 padding-top-10">
                                        
                                                                                        </div>
                                                                                        <div class="col-md-2 padding-top-10">
                                                                                            <button type="button" name="btncancel" id="btncancel" class="btn btn-danger" onclick="getMainPage()" style="width: 160px">&nbsp Close &nbsp</button>
                                                                                        </div>
                                        
                                                                                        <div class="col-md-1 padding-top-10">
                                                                                        </div>
                                        
                                                                                        <div class="col-md-2 padding-top-10">
                                        
                                                                                        </div>
                                                                                        <div class="col-md-2 padding-top-10">
                                                                                            <button type="button" name="btnprint" id="btncancel" class="btn btn-info" onclick="getPrintPage()" style="width: 160px">&nbsp Print Quotation &nbsp</button>
                                                                                        </div>-->
                                    </div>	

                            </form>

                            <h5 id="dsp"></h5>
                        </div>
                    </div>
                </div>

                <!--
                        Begining of PHP code
                        The code gets executed when user clicks the save button
                -->


                <script type="text/javascript">
                    document.getElementById('mileage').disabled = true;
                    document.getElementById("btnsavebooking").disabled = true;
                </script>

                <script language="JavaScript" type="text/javascript">
                    function getMainPage() {
                        window.location.href = "main.php";
                    }
                </script>
                <script language="JavaScript" type="text/javascript">
                    function getJobPage() {
                        window.location.href = "job.php?evid=" +<?php
                                            echo $_GET['qid'];
                                            ?>;
                    }
                </script>
                <script language="JavaScript" type="text/javascript">
                    function getPrintPage() {
                        window.location.href = "printInvoice.php?qid=" +<?php
                                            echo $_GET['qid'];
                                            ?>;
                    }
                </script>

                <script src="jquery.min.js"></script>
                <script src="js/bootstrap.min.js"></script>

                </body>
                </html>