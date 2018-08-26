<?php
session_start();
include('../includes/dbcon.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $postalcode = $_POST['postalcode'];
    $phonenumber = $_POST['phonenumber'];
    $employeetype = $_POST['employeetype'];
    $jobtitle = $_POST['jobtitle'];
    $password = $_POST['password'];

    mysqli_query($con, "UPDATE employee SET name='$name',surname='$surname',email='$email',city='$city',postalcode='$postalcode',"
            . "phonenumber='$phonenumber',employeetype='$employeetype',jobtitle='$jobtitle',password='$password' where employee_id='$id'")
            or die(mysqli_error($con));

    $_SESSION['EmployeeSuccess'] = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                             Employee updated successfully
                                                        </div>
                                                        <div id="error"></div>';
    echo "<script>document.location='employees.php'</script>";
} 

