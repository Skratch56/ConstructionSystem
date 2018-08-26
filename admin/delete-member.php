<?php
include('../includes/dbcon.php');
mysqli_query($con, "delete from customer where customer_id=" . $_GET['stid'])or die(mysqli_error());
echo "<script>swal('Member Deleted Successfully');</script>";
echo "<script type='text/javascript'> document.location = 'members.php'; </script>";
?>