<?php

include('../includes/dbcon.php');

$name = $_POST['name'];
$city = $_POST['city'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber'];
$fieldtype = $_POST['fieldtype'];
$postalcode = $_POST['postalcode'];



$result = mysqli_query($con, "SELECT * from engineer where email='$email'");
$count = mysqli_num_rows($result);

if ($count == 0) {
    mysqli_query($con, "INSERT INTO engineer(name,city,email,phone_number,field_type,postal_code) 
			VALUES('$name','$city','$email','$phonenumber','$fieldtype','$postalcode')")or die(mysqli_error());
    echo "<script type='text/javascript'>alert('Successfully added new Engineer!');</script>";
    echo "<script>document.location='employees.php'</script>";
} else {
    echo "<script type='text/javascript'>alert('Engineer already added!');</script>";
    echo "<script>document.location='employees.php'</script>";
}
?>