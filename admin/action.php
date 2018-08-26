<?php

session_start();
include('../includes/dbcon.php');

$idArr = $_POST['checked_id'];
$idArr2 = $_POST['checked_id2'];
$idArr3 = $_POST['checked_id3'];

$evid = $_SESSION['quotation_no'];

$Date = date("Y-m-d");


for ($i = 0; $i < count($idArr); $i++) {
    
    $id = mysql_real_escape_string($idArr[$i]);

    $query4 = "INSERT INTO `quote/service` (`ServiceID`, `QuotationID`, `Date`) VALUES ('" . $id . "', '" . $evid . "', '" . $Date . "');";
    mysqli_query($con, $query4);
}

for ($i = 0; $i < count($idArr2); $i++) {
    
    $id = mysql_real_escape_string($idArr2[$i]);

    $query4 = "INSERT INTO `quote/service` (`ServiceID`, `QuotationID`, `Date`) VALUES ('" . $id . "', '" . $evid . "', '" . $Date . "');";
    mysqli_query($con, $query4);
}
for ($i = 0; $i < count($idArr3); $i++) {
  
    $id = mysql_real_escape_string($idArr3[$i]);

    $query4 = "INSERT INTO `quote/service` (`ServiceID`, `QuotationID`, `Date`) VALUES ('" . $id . "', '" . $evid . "', '" . $Date . "');";
    mysqli_query($con, $query4);
}

$_SESSION['success_msg'] = 'Successful';
header("Location:servicedetails.php?qid=" . $evid . "");
?>