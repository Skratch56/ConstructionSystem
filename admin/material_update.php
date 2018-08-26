<?php
session_start();
include('../includes/dbcon.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    

    mysqli_query($con, "UPDATE material SET Type='$type',Quantity='$quantity',Description='$description',Price='$price'"
                    . " where material_id='$id'")
            or die(mysqli_error($con));
$_SESSION['MaterialSuccess'] = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                             Material updated successfully
                                                        </div>
                                                        <div id="error"></div>';
    echo "<script>document.location='material.php'</script>";
} 

