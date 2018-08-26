<?php

session_start();
include('../includes/dbcon.php');

$type = $_POST['type'];
$quantity = $_POST['quantity'];
$description = $_POST['description'];
$price = $_POST['price'];





mysqli_query($con, "INSERT INTO material(type,quantity,description,price) 
			VALUES('$type','$quantity','$description','$price')")or die(mysqli_error());
$_SESSION['MaterialSuccess'] = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                             Material added successfully
                                                        </div>
                                                        <div id="error"></div>';
echo "<script>document.location='material.php'</script>";
?>