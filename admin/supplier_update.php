<?php
session_start();
include('../includes/dbcon.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $suppliernumber = $_POST['suppliernumber'];

    mysqli_query($con, "UPDATE supplier SET Name='$name',Supplier_Number='$suppliernumber', Email='$email'"
                    . " where supplier_id='$id'")
            or die(mysqli_error($con));

    $_SESSION['SupplierSuccess'] = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                             Supplier updated successfully
                                                        </div>
                                                        <div id="error"></div>';
    echo "<script>document.location='supplier.php'</script>";
} 

