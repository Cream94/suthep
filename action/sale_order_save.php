<?php
session_start();
require_once '../database/connector.php';
$prod_id = isset($_POST["prod_id"]) ? $_POST["prod_id"] : null; // short if.
$number = isset($_POST["number"]) ? $_POST["number"] : null; // short if.
$cust_id = isset($_POST["cus_id"]) ? $_POST["cus_id"] : null; // short if.
$tax_id = isset($_POST["tax_id"]) ? $_POST["tax_id"] : null; // short if.
$prod_detail = isset($_POST["prod_detail"]) ? $_POST["prod_detail"] : null; // short if.
$adminID = $_SESSION["login_id"];
if ($prod_id != null && $number != null && $cust_id != null && $tax_id != null && $prod_detail != null) {
  $sqlSO_ID = "SELECT max(so_id) as so_id FROM sale_order";
  $querySO = mysqli_query($conn, $sqlSO_ID) or die('Die query');
  $rowSO = mysqli_fetch_assoc($querySO);
  $soid = $rowSO["so_id"];
  $soid += 1;
  for ($i=0; $i < sizeof($prod_id); $i++) {
    $sql = "INSERT INTO sale_order (so_id, cus_id, admin_id, prod_id, number, tax_id) ";
    $sql .= " VALUES($soid, $cust_id[$i], $adminID, $prod_id[$i], $number[$i], $tax_id[$i])";
    mysqli_query($conn, $sql) or die('Die query');
  }
  header("Location: http://localhost/suthep/sale_order_invoice.php?soid=$soid");
  die();
} else {
  echo "Nope";
}

 ?>
