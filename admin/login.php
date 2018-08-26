<?php

session_start();

include('../includes/dbcon.php');

if (isset($_POST['login'])) {

    $user_unsafe = $_POST['username'];
    $pass_unsafe = $_POST['password'];

    $user = mysqli_real_escape_string($con, $user_unsafe);
    $pass = mysqli_real_escape_string($con, $pass_unsafe);

    $query = mysqli_query($con, "select * from employee where email='$user'")or die(mysqli_error($con));
    $row = mysqli_fetch_array($query);
    $query2 = mysqli_query($con, "select * from employee where email='$user' and password='$pass'")or die(mysqli_error($con));
    $row2 = mysqli_fetch_array($query2);
    $id = $row['employee_id'];
    /*  $first=$row['admin_first'];
      $last=$row['admin_last']; */
    $counter = mysqli_num_rows($query);
    $counter2 = mysqli_num_rows($query2);

    if ($counter == 0 && $counter2 == 0) {
        $_SESSION['loginerror'] = '<div class="alert alert-danger left-icon-alert"  role="alert">
                                                             Invalid Email Address, Please enter the correct Email Address
                                                        </div>
                                                        <div id="error"></div>';
        echo "<script type='text/javascript'>document.location='index.php';</script>";
    }else if($counter2 == 0){
        $_SESSION['loginerror']= '<div class="alert alert-danger left-icon-alert"  role="alert">
                                                             Invalid Password, Please enter the correct Password
                                                        </div>
                                                        <div id="error"></div>';
         echo "<script type='text/javascript'>document.location='index.php';</script>";
    }else {
        $_SESSION['id'] = $id;
        /* $_SESSION['name']=$first." ".$last; */

        echo "<script type='text/javascript'>document.location='dashboard.php'</script>";
    }
}
?>