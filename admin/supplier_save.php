<?php
session_start();
include('../includes/dbcon.php');

$name = $_POST['name'];

$suppliernumber = $_POST['suppliernumber'];
$email = $_POST['email'];




mysqli_query($con, "INSERT INTO supplier(Name,Supplier_Number,Email) 
			VALUES('$name','$suppliernumber','$email')")or die(mysqli_error());
$_SESSION['SupplierSuccess'] = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                             Customer added successfully
                                                        </div>
                                                        <div id="error"></div>';
echo "<script>document.location='supplier.php'</script>";
?>