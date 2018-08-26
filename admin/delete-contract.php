<?php
include('../includes/dbcon.php');
mysqli_query($con, "delete from contract where ContractID=".$_GET['stid'])or die(mysqli_error());
    echo "<script>swal('Contract Deleted Successfully');</script>";
echo "<script type='text/javascript'> document.location = 'contract.php'; </script>";

?>