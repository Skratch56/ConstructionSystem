<?php

session_start();
include('../includes/dbcon.php');

$idArr = $_POST['checked_id'];
$qtyArr = $_POST['qtyoil11'];
$idArr2 = $_POST['checked_id2'];
$qtyArr2 = $_POST['qtyoil12'];
$idArr3 = $_POST['checked_id3'];
$qtyArr3 = $_POST['qtyoil13'];

$evid = $_SESSION['purchaseid'];

$Date = date("Y-m-d");


for ($i = 0; $i < count($idArr); $i++) {

    $id = mysql_real_escape_string($idArr[$i]);
    $qty = $qtyArr[$i];
    $query4 = "INSERT INTO `purchase/material` (`material_id`, `PurchaseOrderID`, `quantity_purchase`) VALUES ('" . $id . "', '" . $evid . "', '" . $qty . "');";
    mysqli_query($con, $query4);
    $query9 = mysqli_query($conn, "Select * from `material` where material_id=" . $id . "");
    while ($row = mysqli_fetch_assoc($query9)) {
        $qtyinstock = $row['quantity'];
        $newqty = $qtyinstock + $qty;
        $query10 = "update `material` set quantity ='" . $newqty . "' where material_id=" . $id . "";
        mysqli_query($conn, $query10);
    }
}

for ($i = 0; $i < count($idArr2); $i++) {

    $id = mysql_real_escape_string($idArr2[$i]);
    $qty = $qtyArr2[$i];
    $query4 = "INSERT INTO `purchase/material` (`material_id`, `PurchaseOrderID`, `quantity_purchase`) VALUES ('" . $id . "', '" . $evid . "', '" . $qty . "');";
    mysqli_query($con, $query4);
    $query9 = mysqli_query($conn, "Select * from `material` where material_id=" . $id . "");
    while ($row = mysqli_fetch_assoc($query9)) {
        $qtyinstock = $row['quantity'];
        $newqty = $qtyinstock + $qty;
        $query10 = "update `material` set quantity ='" . $newqty . "' where material_id=" . $id . "";
        mysqli_query($conn, $query10);
    }
}
for ($i = 0; $i < count($idArr3); $i++) {

    $id = mysql_real_escape_string($idArr3[$i]);
    $qty = $qtyArr3[$i];
    $query4 = "INSERT INTO `purchase/material` (`material_id`, `PurchaseOrderID`, `quantity_purchase`) VALUES ('" . $id . "', '" . $evid . "', '" . $qty . "');";
    mysqli_query($con, $query4);
    $query9 = mysqli_query($conn, "Select * from `material` where material_id=" . $id . "");
    while ($row = mysqli_fetch_assoc($query9)) {
        $qtyinstock = $row['quantity'];
        $newqty = $qtyinstock + $qty;
        $query10 = "update `material` set quantity ='" . $newqty . "' where material_id=" . $id . "";
        mysqli_query($conn, $query10);
    }
}

$_SESSION['success_msg'] = 'Successful';
header("Location:servicedetailsmaterial.php?pid=" . $evid . "");
?>