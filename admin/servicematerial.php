<?php
session_start();
if (empty($_SESSION['id'])):
    header('Location:index.php');
endif;

$_SESSION['purchaseid'] = $_GET['pid'];
?>

<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <script type="text/javascript">
            function delete_confirm() {
            var result = confirm("Are you sure to delete users?");
            if (result) {
            return true;
            } else {
            return false;
            }
            }

            $(document).ready(function () {
            $('#select_all').on('click', function () {
            if (this.checked) {
            $('.checkbox').each(function () {
            this.checked = true;
            });
            } else {
            $('.checkbox').each(function () {
            this.checked = false;
            });
            }
            });
            $('.checkbox').on('click', function () {
            if ($('.checkbox:checked').length == $('.checkbox').length) {
            $('#select_all').prop('checked', true);
            } else {
            $('#select_all').prop('checked', false);
            }
            });
            });
        </script>
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
        <div class="content" style="margin-top:10px">

            <!-- Sidebar -->
            <?php include('../includes/sidebar.php'); ?>

            <!-- Sidebar ends -->

            <!-- Main bar -->
            <div class="mainbar">

                <!-- Page heading -->
                <div class="page-head">
                    <h2 class="pull-left"><i class="fa fa-gears"></i> Materials</h2>

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
                <form name="bulk_action_form" action="actionmaterial.php" id="form1" method="post" >



                    ?>

                    <div class="container">
                        <?php
                        if (isset($_SESSION['success_msg']) == 'Not Found') {
                            echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Material Captured Successfully</div>';
                            $_SESSION['success_msg'] = null;
                        }
                        ?>

                        <div class="panel panel-default">

                            <div class="panel-heading">Material Details</div>

                            <div class="panel-body">


                                <!-- Start of search form -->

                                <div class="row">
                                    <div class="col-md-2 padding-top-5" align="right">
                                        Description:
                                    </div>

                                    <div class="col-md-2">
                                        <?php
                                        include('../includes/dbcon.php');
                                        $query2 = "SELECT * from Category WHERE Description = 'Roadworks'";
                                        $result2 = mysqli_query($con, $query2);

                                        while ($rows2 = mysqli_fetch_array($result2)) {
                                            $category_desc = $rows2['Description'];
                                            $category_id = $rows2['Category_ID'];
                                        }


                                        echo '<input type="text" class="form-control" name="categorydesc1" id="categorydesc1" value="' . $category_desc . '" readonly />';

                                        echo '<input type="hidden" class="form-control" name="category1id" id="category1id" value="' . $category_id . '" readonly />';
                                        ?>
                                    </div>
                                    <div class="col-md-3 padding-top-10">
                                        <label class="control-label" for="HexInput1"> 
                                            &nbsp&nbsp<input onclick="showhide1();" type="checkbox" name="data1" id="HexInput1"  value="Roadworks"> Select Category
                                            &nbsp&nbsp&nbsp&nbsp&nbsp</label></div>
                                    <div class="col-md-4 padding-top-5"></div>


                                </div>


                                <div class="row">
                                    <div class="col-md-2 padding-top-10" align="right">
                                        Description:
                                    </div>

                                    <div class="col-md-2 padding-top-10">
                                        <?php
                                        $query2 = "SELECT * from category WHERE Description = 'Buildings'";
                                        $result2 = mysqli_query($con, $query2);

                                        while ($rows2 = mysqli_fetch_array($result2)) {
                                            $category_desc = $rows2['Description'];
                                            $category_id = $rows2['Category_ID'];
                                        }


                                        echo '<input type="text" class="form-control" name="categorydesc2" id="categorydesc2" value="' . $category_desc . '" readonly />';

                                        echo '<input type="hidden" class="form-control" name="category2id" id="category2id" value="' . $category_id . '" readonly />';
                                        ?>
                                    </div>
                                    <div class="col-md-3 padding-top-10">
                                        <label class="control-label" for="HexInput2"> 
                                            &nbsp&nbsp<input onclick="showhide2();" type="checkbox" name="data2" id="HexInput2"  value="Buildings"> Select Category
                                            &nbsp&nbsp&nbsp&nbsp&nbsp</label></div>
                                    <div class="col-md-4 padding-top-5"></div>

                                </div>

                                <div class="row">
                                    <div class="col-md-2 padding-top-10" align="right">
                                        Description:
                                    </div>

                                    <div class="col-md-2 padding-top-10">
                                        <?php
                                        $query2 = "SELECT * from category WHERE Description = 'Other Materials'";
                                        $result2 = mysqli_query($con, $query2);

                                        while ($rows2 = mysqli_fetch_array($result2)) {
                                            $category_desc = $rows2['Description'];
                                            $category_id = $rows2['Category_ID'];
                                        }


                                        echo '<input type="text" class="form-control" name="categorydesc3" id="categorydesc3" value="Other Materials" readonly />';

                                        echo '<input type="hidden" class="form-control" name="category3id" id="category3id" value="' . $category_id . '" readonly />';
                                        ?>
                                    </div>
                                    <div class="col-md-3 padding-top-10">
                                        <label class="control-label" for="HexInput3"> 
                                            &nbsp&nbsp<input onclick="showhide3();" type="checkbox" name="data3" id="HexInput3"  value="Other Materials"> Select Category
                                            &nbsp&nbsp&nbsp&nbsp&nbsp</label></div>
                                    <div class="col-md-4 padding-top-5"></div>

                                </div>

                            </div>
                        </div>
                        <div id="msgparts" class="alert alert-danger alert-dismissable" style="display:none;" style="visibility:hidden;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Enter a number between 1 and the quantity in stock.</div>
                        <div class="panel panel-default">
                            <div class="panel-heading">Material Details</div>
                            <div class="panel-body">



                                <div class="row" id="rowoil" style="display:none;" style="visibility:hidden;" >
                                    <div class="widget-content">
                                        <div class="padd">
                                            <div class="page-tables">
                                                <!-- Table -->
                                                <div class="table-responsive">
                                                    <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th><input type="checkbox" name="select_all" id="select_all" value=""/></th>        
                                                                <th>MaterialID</th>
                                                                <th>Description</th>
                                                                <th>Cost</th>
                                                                <th>Quantity In Stock</th>
                                                                <th>Quantity</th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        $query = mysqli_query($con, "SELECT * FROM material where type = '1'");
                                                        if (mysqli_num_rows($query) > 0) {
                                                            while ($row = mysqli_fetch_assoc($query)) {
                                                                ?>
                                                                <tr>
                                                                    <td align="center"><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $row['material_id']; ?>"/></td>        
                                                                    <td><?php echo $row['material_id']; ?></td>
                                                                    <td><?php echo $row['description']; ?></td>
                                                                    <td><?php echo "R".$row['price']; ?></td>
                                                                    <td><?php
                                                                        if ($row['quantity'] == 0) {
                                                                            echo "no parts in stock";
                                                                        } else {
                                                                            echo $row['quantity'];
                                                                        }
                                                                        ?></td>
                                                                    <td>
                                                                        <input type="text" min="1" max="<?php echo $row['qty_in_stock']; ?>"class="form-control" onkeyup="numberValidateqty(this)" name="qtyoil11[]" id="qtyoil2" value=""   />
                                                                    </td>
                                                                </tr> 
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <tr><td colspan="5">No records found.</td></tr> 
                                                        <?php } ?>
                                                    </table>



                                                    <div class="col-md-4 padding-top-5"></div>
                                                </div>
                                            </div></div></div></div>




                                <div class="row" id="rowpads" style="display:none;" style="visibility:hidden;">
                                    <br>
                                    <div class="widget-content">
                                        <div class="padd">
                                            <div class="page-tables">
                                                <!-- Table -->
                                                <div class="table-responsive">
                                                    <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th><input type="checkbox" name="select_all" id="select_all" value=""/></th>        
                                                                <th>MaterialID</th>
                                                                <th>Description</th>
                                                                <th>Cost</th>
                                                                <th>Quantity In Stock</th>
                                                                <th>Quantity</th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        $query = mysqli_query($con, "SELECT * FROM Material where type = '2'");
                                                        if (mysqli_num_rows($query) > 0) {
                                                            while ($row = mysqli_fetch_assoc($query)) {
                                                                ?>
                                                                <tr>
                                                                    <td align="center"><input type="checkbox" name="checked_id2[]" class="checkbox" value="<?php echo $row['material_id']; ?>"/></td>        
                                                                    <td><?php echo $row['material_id']; ?></td>
                                                                    <td><?php echo $row['description']; ?></td>
                                                                    <td><?php echo "R".$row['price']; ?></td>
                                                                    <td><?php
                                                                        if ($row['quantity'] == 0) {
                                                                            echo "no parts in stock";
                                                                        } else {
                                                                            echo $row['quantity'];
                                                                        }
                                                                        ?></td>
                                                                    <td>
                                                                        <input type="text" min="1" max="<?php echo $row['qty_in_stock']; ?>"class="form-control" onkeyup="numberValidateqty(this)" name="qtyoil12[]" id="qtyoil2" value=""   />
                                                                    </td>
                                                                </tr> 
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <tr><td colspan="5">No records found.</td></tr> 
                                                        <?php } ?>
                                                    </table>



                                                    <div class="col-md-4 padding-top-5"></div>
                                                </div>
                                            </div></div></div></div>

                                <div class="row" id="rowpistol" style="display:none;" style="visibility:hidden;">
                                    <br> <div class="widget-content">
                                        <div class="padd">
                                            <div class="page-tables">
                                                <!-- Table -->
                                                <div class="table-responsive">
                                                    <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th><input type="checkbox" name="select_all" id="select_all" value=""/></th>        
                                                                <th>MaterialID</th>
                                                                <th>Description</th>
                                                                <th>Cost</th>
                                                                <th>Quantity In Stock</th>
                                                                 <th>Quantity</th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        $query = mysqli_query($con, "SELECT * FROM Material where type = '3'");
                                                        if (mysqli_num_rows($query) > 0) {
                                                            $cnt = 1;
                                                            while ($row = mysqli_fetch_assoc($query)) {
                                                                ?>
                                                                <tr>
                                                                    <td align="center"><input type="checkbox" name="checked_id3[]" class="checkbox" value="<?php echo $row['material_id']; ?>"/></td>        
                                                                    <td><?php echo $row['material_id']; ?></td>
                                                                    <td><?php echo $row['description']; ?></td>
                                                                    <td><?php echo "R".$row['price']; ?></td>
                                                                    <td><?php
                                                                        if ($row['quantity'] == 0) {
                                                                            echo "no parts in stock";
                                                                        } else {
                                                                            echo $row['quantity'];
                                                                        }
                                                                        ?></td>
                                                                    <td>
                                                                        <input type="text" min="1" max="<?php echo $row['qty_in_stock']; ?>"class="form-control" onkeyup="numberValidateqty(this)" name="qtyoil13[]" id="qtyoil2" value=""   />
                                                                    </td>
                                                                </tr> 
                                                                <?php
                                                                $cnt += 1;
                                                            }
                                                        } else {
                                                            ?>
                                                            <tr><td colspan="5">No records found.</td></tr> 
                                                        <?php } ?>
                                                    </table>


                                                    <div class="col-md-4 padding-top-5"></div>
                                                </div>
                                            </div></div></div></div>

                                <br>

                                <div class="row padding-top-10"> 

                                    <div class="col-md-2 padding-top-10">
                                        <input type="submit" name="bulk_add_submit" id="bulk_add_submit" onclick="submitforms();" class="btn btn-success" value="save" style="width:160px" />
                                    </div>

                                    <div class="col-md-1 padding-top-10">
                                    </div>

                                    <div class="col-md-2 padding-top-10">

                                    </div>

                                    <div class="col-md-1 padding-top-10">
                                    </div>

                                    <div class="col-md-2 padding-top-10">

                                    </div>
                                    <div class="col-md-2 padding-top-10">
                                        <button type="button" name="btncancel" id="btncancel" class="btn btn-danger" onclick="getMainPage()" style="width: 160px">&nbsp Close &nbsp</button>
                                    </div>
                                </div>	



                                <h5 id="dsp"></h5>

                            </div>


                        </div>

                    </div></div></div>
        <?php
        if (isset($_GET['suc'])) {
            echo "<script language='JavaScript' type='text/javascript'> "
            . "document.getElementById('bulk_add_submit').disabled = true;"
            . "document.getElementById('btnnext').disabled = false;</script>";
        }
        ?>
        <!--
                Begining of PHP code
                The code gets executed when user clicks the save button
        -->
        <?php
        if (isset($_POST['bulk_add_submit'])) {
//            $evaluation_id = $_GET['evid'];
//            $category1 = $_POST['category1id'];
//            $category2 = $_POST['category2id'];
//            $category3 = $_POST['category3id'];
//            $part1 = $_POST['partid1'];
//            $part2 = $_POST['partid2'];
//            $part3 = $_POST['partid3'];
//            $qty1 = $_POST['qtyoil1'];
//            $qty2 = $_POST['qtypads1'];
//            $qty3 = $_POST['qtypistol1'];
//            if (isset($_POST['category1id'])) {
//                $query1 = "INSERT INTO `evaluated_category` (`category_id`, `evaluation_no`, `no_of_hours`) VALUES ('" . $category1 . "', " . $evaluation_id . ", " . $category1 . ");";
//                $result1 = mysqli_query($conn, $query1);
//            }
//            if (isset($_POST['category2id'])) {
//                $query2 = "INSERT INTO `evaluated_category` (`category_id`, `evaluation_no`, `no_of_hours`) VALUES ('" . $category2 . "', " . $evaluation_id . ", " . $category2 . ");";
//                $result2 = mysqli_query($conn, $query2);
//            }
//            if (isset($_POST['category3id'])) {
//                $query3 = "INSERT INTO `evaluated_category` (`category_id`, `evaluation_no`, `no_of_hours`) VALUES ('" . $category3 . "', " . $evaluation_id . ", " . $category3 . ");";
//                $result3 = mysqli_query($conn, $query3);
//            }
//
//            if (isset($_POST['partid1'])) {
//                $query4 = "INSERT INTO `quoted_parts` (`part_no`, `evaluation_no`, `qty_quoted`) VALUES ('" . $part1 . "', '" . $evaluation_id . "', '" . $qty1 . "');";
//                $result4 = mysqli_query($conn, $query4);
//            }
//            if (isset($_POST['partid2'])) {
//                $query5 = "INSERT INTO `quoted_parts` (`part_no`, `evaluation_no`, `qty_quoted`) VALUES ('" . $part2 . "', '" . $evaluation_id . "', '" . $qty2 . "');";
//                $result5 = mysqli_query($conn, $query5);
//            }
//            if (isset($_POST['partid3'])) {
//                $query6 = "INSERT INTO `quoted_parts` (`part_no`, `evaluation_no`, `qty_quoted`) VALUES ('" . $part3 . "', '" . $evaluation_id . "', '" . $qty3 . "');";
//                $result6 = mysqli_query($conn, $query6);
//            }
//
//            echo "<script>
//						document.getElementById('btnsavebooking').disabled = true;
//                                                document.getElementById('btnnext').disabled = false;
//						alert('Material captured successfully');
//					</script>";
            //echo $booking_date ." | " .$booking_time ." | " .$status ." | " .$reg_num ." | " .$customer_no ;
        }
        ?>

        <script type="text/javascript">
            document.getElementById('mileage').disabled = true;
            document.getElementById("btnsavebooking").disabled = true;
        </script>
        <script language="JavaScript" type="text/javascript">
            function getMaterialPage() {
            window.location.href = "servicedetails.php?qid=" +<?php
        echo $_SESSION['evaluation_no'];
        ?>;
            }
        </script>


        <script language="JavaScript" type="text/javascript">
            function showhide1()
            {
            var div = document.getElementById("rowoil");
            var div2 = document.getElementById("hours1");
            var div3 = document.getElementById("hoursin1");
            if (div.style.display !== "none") {
            div.style.display = "none";
            div.style.visibility = "hidden";
            div2.style.display = "none";
            div2.style.visibility = "hidden";
            div3.style.display = "none";
            div3.style.visibility = "hidden";
            div3.required = false;
            } else {
            div.style.display = "block";
            div.style.visibility = "visible";
            div2.style.display = "block";
            div2.style.visibility = "visible";
            div3.style.display = "block";
            div3.style.visibility = "visible";
            div3.required = true;
            }
            }
        </script>

        <script language="JavaScript" type="text/javascript">
            function showhide2()
            {
            var div = document.getElementById("rowpads");
            var div2 = document.getElementById("hours2");
            var div3 = document.getElementById("hoursin2");
            if (div.style.display !== "none") {
            div.style.display = "none";
            div.style.visibility = "hidden";
            div2.style.display = "none";
            div2.style.visibility = "hidden";
            div3.style.display = "none";
            div3.style.visibility = "hidden";
            div3.required = false;
            } else {
            div.style.display = "block";
            div.style.visibility = "visible";
            div2.style.display = "block";
            div2.style.visibility = "visible";
            div3.style.display = "block";
            div3.style.visibility = "visible";
            div3.required = true;
            }
            }
        </script>
        <script language="JavaScript" type="text/javascript">
            function showhide3()
            {
            var div = document.getElementById("rowpistol");
            var div2 = document.getElementById("hours3");
            var div3 = document.getElementById("hoursin3");
            if (div.style.display !== "none") {
            div.style.display = "none";
            div.style.visibility = "hidden";
            div2.style.display = "none";
            div2.style.visibility = "hidden";
            div3.style.display = "none";
            div3.style.visibility = "hidden";
            div3.required = false;
            } else {
            div.style.display = "block";
            div.style.visibility = "visible";
            div2.style.display = "block";
            div2.style.visibility = "visible";
            div3.style.display = "block";
            div3.style.visibility = "visible";
            div3.required = true;
            }
            }
        </script>



        <script language="JavaScript" type="text/javascript">
            function getMainPage() {
            window.location.href = "dashboard.php";
            }
                                        </                        script>
                                        <script type="te            xt/javas                        cript">
function numberValidat                                ehours(i                        nput) {
var rege                                x = /[^                        0-9]/g;
input.value = input.value.repl                                ace(rege                        x, "");
v                                ar minTi                        me = 1;
v                                ar maxTi                        me = 9;
var value = input.value;
var reg                                ex2 = /[                        0-9]/g;
if (minTime > value || value > maxTi                        me) {


input.value = input.value.repla                                    ce(regex                        2, "");
var div = document.getElementById                                      ('msgs e r                              vice');
div.style.dis                                    play = '                        b l ock';
div.style.visibili                                  ty = 'vi                        sible';
}

}
    </                            script>
        <script type                                ="text/javascript">
function numberV                                    alidateqty(input) {
var regex = /[^0-9]/g;
input.value = input.value.r                                    eplace(regex, "");
var minTime = p                                    arseInt(input.min);
var maxTime = p                                    arseInt(input.max);
var v                                    alue = input.value;
var regex2 = /[0-9]/g;
if (minTime > value || value > maxTime) {

input.value = input.value.r                                        eplace(regex2, "");
var div = document.getEleme                                        ntById('msgparts');
div.style.display = 'block';
div.style.visi                                    bility = 'visible';
}

}
            </script>

            <script src="jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
        </form>
        <script language="JavaScript" type="text/javascript">
            function submitforms()
            {
            document.getElementById("form1").submit();
            }
        </script>

    </body>
</html>