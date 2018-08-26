
<?php
session_start();
include('../includes/dbcon.php');

$name = $_POST['name'];
$email = $_POST['email'];
$city = $_POST['city'];
$postalcode = $_POST['postalcode'];
$phonenumber = $_POST['phonenumber'];
$result = mysqli_query($con, "SELECT * from customer where email='$email'");
$count = mysqli_num_rows($result);

if ($count == 0) {
    mysqli_query($con, "INSERT INTO customer(name,email,city,postalcode,phonenumber) 
			VALUES('$name','$email','$city','$postalcode','$phonenumber')")or die(mysqli_error());

    $_SESSION['CustomerSuccess'] = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                             Customer added successfully
                                                        </div>
                                                        <div id="error"></div>';
    echo "<script>document.location='members.php'</script>";
} else {

    $_SESSION['CustomerSuccess'] = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                             Something went wrong, Please try again
                                                        </div>
                                                        <div id="error"></div>';
    echo "<script>document.location='members.php'</script>";
}
?>
 