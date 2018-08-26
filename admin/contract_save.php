<?php

session_start();
include('../includes/dbcon.php');

$contracttype = $_POST['contracttype'];
$date = $_POST['date'];
$status = $_POST['status'];
$customerid = $_POST['customerid'];
$quotation = $_POST['quotation'];





mysqli_query($con, "INSERT INTO contract(contract_type,status,date,customer_id,quotationid) 
			VALUES('$contracttype','$status','$date','$customerid','$quotation')")or die(mysqli_error());
$_SESSION['ContractSuccess'] = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                             Contract added successfully
                                                        </div>
                                                        <div id="error"></div>';
echo "<script>document.location='contract.php'</script>";
?>