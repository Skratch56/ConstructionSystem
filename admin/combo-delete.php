<?php
include('../includes/dbcon.php');
mysqli_query($con, "delete from service where ServiceID=".$_GET['stid'])or die(mysqli_error());
    echo "<script>swal('Service Deleted Successfully');</script>";
echo "<script type='text/javascript'> document.location = 'combo.php'; </script>";

?>