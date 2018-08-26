<?php
session_start();
include('../includes/dbcon.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['servicetype'];
    $price = $_POST['cost'];
    $menu = $_POST['category'];


    mysqli_query($con, "UPDATE service SET ServiceType='$name', Cost='$price', Category_ID='$menu' where ServiceID='$id'")
            or die(mysqli_error($con));

$_SESSION['ServiceSuccess']='<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                             Service updated successfully
                                                        </div>
                                                        <div id="error"></div>';
    echo "<script type='text/javascript'>swal('Successfully updated Service details!');</script>";
    echo "<script>document.location='combo.php'</script>";
} 

