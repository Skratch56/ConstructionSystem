<?php
session_start();
include('../includes/dbcon.php');

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$city = $_POST['city'];
$postalcode = $_POST['postalcode'];
$phonenumber = $_POST['phonenumber'];
$employeetype = $_POST['employeetype'];
$jobtitle = $_POST['jobtitle'];
$password = $_POST['password'];

$result = mysqli_query($con, "SELECT * from employee where email='$email'");
$count = mysqli_num_rows($result);

if ($count == 0) {
    mysqli_query($con, "INSERT INTO employee(name,surname,email,city,postalcode,phonenumber,employeetype,jobtitle,password) 
			VALUES('$name','$surname','$email','$city','$postalcode','$phonenumber','$employeetype','$jobtitle','$password')")or die(mysqli_error());
    $_SESSION['EmployeeSuccess'] = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                             Employee added successfully
                                                        </div>
                                                        <div id="error"></div>';
    echo "<script>document.location='employees.php'</script>";
} else {
    $_SESSION['EmployeeSuccess'] = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                             Employee already exists
                                                        </div>
                                                        <div id="error"></div>';
    echo "<script>document.location='employees.php'</script>";
}
?>