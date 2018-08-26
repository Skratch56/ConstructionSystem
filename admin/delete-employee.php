<?php

include('../includes/dbcon.php');



mysqli_query($con, "delete from employee where employee_id=".$_GET['stid'])or die(mysqli_error());


    echo "<script>swal('Employee Deleted Successfully');</script>";
    echo "<script type='text/javascript'> document.location = 'employees.php'; </script>";

?>