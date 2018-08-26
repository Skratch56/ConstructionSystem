<?php

session_start();
include '../includes/dbcon.php';

?>

<?php


global $conn;
$query1 = "";

/*
  When user clicks Log in button
  Now get data from database
 */

if (isset($_POST['reset_empnum'])) {
    $found = false;
    $email;

    if (strlen($_POST['reset_empnum']) > 0) {
        $staffno = $_POST['reset_empnum'];
        $query1 = "SELECT * FROM employee";

        if (strlen($query1) > 0) {
            $result1 = mysqli_query($con, $query1);

            while ($rows1 = mysqli_fetch_array($result1)) {
                $rows_data1 = $rows1['email'];
                $Question = $rows1['email'];
                $_SESSION['password'] = $rows1['employee_id'];
                if ($staffno == $rows_data1) {
                    $found = true;
                    break;
                }
            }
        }

        if ($found == true) {
            echo '<div class="alert alert-success" role="alert">Reseting password for email: ' . $Question . '. Enter Employee ID to Confirm <a href="#" data-toggle="modal" data-target="#mymodal2">CLICK HERE!!!</a> </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Employee Email entered is invalid!! Please check your Employee Email and try again.</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Please enter your employee number to reset your password!</div>';
    }
}

if (isset($_POST['reset_answer'])) {
    $found = false;
    $email;

    if (strlen($_POST['reset_answer']) > 0) {
        $staffno = $_POST['reset_answer'];
        $query1 = "SELECT * FROM employee where employee_id ='" . $_SESSION['password'] . "'";

        if (strlen($query1) > 0) {
            $result1 = mysqli_query($con, $query1);

            while ($rows1 = mysqli_fetch_array($result1)) {
                $rows_data1 = $rows1['employee_id'];
                $password = $rows1['password'];

                if ($staffno == $rows_data1) {
                    $found = true;
                    break;
                }
            }
        }

        if ($found == true) {
            echo '<div class="alert alert-success" role="alert">Your password is: ' . $password . '</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">The ID is incorrect please try again.</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Please enter your employee email to reset your password!</div>';
    }
}
?>