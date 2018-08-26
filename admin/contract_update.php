<?php
session_start();
include('../includes/dbcon.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $contracttype = $_POST['contracttype'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $customerid = $_POST['customerid'];
    $quotation = $_POST['quotation'];

    mysqli_query($con, "UPDATE contract SET contract_type='$contracttype', status='$status', date='$date', customer_id='$customerid',QuotationID='$quotation'  where ContractID=".$id)
            or die(mysqli_error($con));


    $_SESSION['ContractSuccess'] = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                             Contract updated successfully
                                                        </div>
                                                        <div id="error"></div>';
    echo "<script>document.location='contract.php'</script>";
} 

