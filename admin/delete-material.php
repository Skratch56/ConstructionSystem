<?php
include('../includes/dbcon.php');
mysqli_query($con, "delete from material where material_id=".$_GET['stid'])or die(mysqli_error());
    echo "<script>swal('Material Deleted Successfully');</script>";
echo "<script type='text/javascript'> document.location = 'material.php'; </script>";

?>