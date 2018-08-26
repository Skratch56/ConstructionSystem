<?php
session_start();
include('../includes/dbcon.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $postalcode = $_POST['postalcode'];
    $phonenumber = $_POST['phonenumber'];


    mysqli_query($con, "UPDATE customer SET name='$name',email='$email',city='$city',postalcode='$postalcode',phonenumber='$phonenumber' where customer_id='$id'")
            or die(mysqli_error($con));

    $_SESSION['CustomerSuccess'] = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                             Customer updated successfully
                                                        </div>
                                                        <div id="error"></div>';
    echo "<script>document.location='members.php'</script>";
} 

