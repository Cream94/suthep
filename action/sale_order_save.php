<?php
session_start();
require_once '../database/connector.php';
$prod_id = isset($_POST["prod_id"]) ? $_POST["prod_id"] : null; // short if.
$number = isset($_POST["number"]) ? $_POST["number"] : null; // short if.
$cust_id = isset($_POST["cust_id"]) ? $_POST["cust_id"] : null; // short if.
$adminID = $_SESSION["login_id"];
$deposit = isset($_POST["deposit"]) ? $_POST["deposit"] : null;
$totalDeposit = isset($_POST["total-deposit"]) ? $_POST["total-deposit"] : null;
if ($deposit == 0 || $deposit == 2) {
  $totalDeposit = 0;
}
if ($prod_id != null && $number != null && $cust_id != null ) {
  $sqlSO_ID = "SELECT max(so_id) as so_id FROM sale_order";
  $querySO = mysqli_query($conn, $sqlSO_ID) or die('Die query1');
  $rowSO = mysqli_fetch_assoc($querySO);
  $soid = $rowSO["so_id"];
  $soid += 1;
  for ($i=0; $i < sizeof($prod_id); $i++) {
    $sql = "INSERT INTO sale_order (so_id, cust_id, admin_id, prod_id, number, deposit, deposit_money) ";
    $sql .= " VALUES($soid, $cust_id[$i], $adminID, '$prod_id[$i]', $number[$i], $deposit, $totalDeposit)";
    mysqli_query($conn, $sql) or die('Die query2 :' . $sql);

    $sqlProd = "SELECT * FROM product WHERE prod_id = $prod_id[$i]";
    $queryProd = mysqli_query($conn, $sqlProd);
    $rowProd = mysqli_fetch_assoc($queryProd);
    $itemRemove = $number[$i] * $rowProd["material_number"];
    $sqlRemoveMat = "UPDATE stock SET number = number - " . $itemRemove . " WHERE mat_id = " . $rowProd["material_id"];
    mysqli_query($conn, $sqlRemoveMat);

  }
  if ($deposit == 0) {
    header("Location: /suthep/money_invoice.php?soid=$soid");
  } else if ($deposit == 1) {
    header("Location: /suthep/deposit_invoice.php?soid=$soid");
  } else if ($deposit == 2) {
    header("Location: /suthep/sale_order_invoice.php?soid=$soid");
  }

  die();
} else {
  echo "Nope";
}

 ?>
