<?php

include('../includes/dbcon.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $fieldtype = $_POST['fieldtype'];
    $postalcode = $_POST['postalcode'];


    mysqli_query($con, "UPDATE engineer SET name='$name',city='$city',email='$email',phone_number='$phonenumber',field_type='$fieldtype',postal_code='$postalcode' where employee_id='$id'")
            or die(mysqli_error($con));

    echo "<script type='text/javascript'>alert('Successfully updated employee details!');</script>";
    echo "<script>document.location='employees.php'</script>";
} 

