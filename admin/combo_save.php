<?php

session_start();
include('../includes/dbcon.php');

$name = $_POST['servicetype'];
$price = $_POST['cost'];
$menu = $_POST['category'];

mysqli_query($con, "INSERT INTO service(ServiceType,Cost,Category_ID) 
			VALUES('$name','$price','$menu')")or die(mysqli_error());
$id = mysqli_insert_id($con);
$_SESSION['ServiceSuccess'] = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                             Service added successfully
                                                        </div>
                                                        <div id="error"></div>';
//			echo "<script type='text/javascript'> $(document).ready(function () {
//                swal('Welcome', 'Welcome to Khomanani Constructions!', 'success'');
//            });</script>";
echo "<script>document.location='combo.php'</script>";
?>