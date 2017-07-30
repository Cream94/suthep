<?php
session_start();
require_once '../database/connector.php';
$mat_id = isset($_POST["mat_id"]) ? $_POST["mat_id"] : null; // short if.
$number = isset($_POST["number"]) ? $_POST["number"] : null; // short if.
$sup_id = isset($_POST["sup_id"]) ? $_POST["sup_id"] : null; // short if.
$adminID = $_SESSION["login_id"];
if ($mat_id != null && $number != null && $sup_id != null) {
  $sqlPO_ID = "SELECT max(po_id) as po_id FROM purchase_order";
  $queryPO = mysqli_query($conn, $sqlPO_ID) or die('Die query');
  $rowPO = mysqli_fetch_assoc($queryPO);
  $poid = $rowPO["po_id"];
  $poid += 1;
  for ($i=0; $i < sizeof($mat_id); $i++) {
    $sql = "INSERT INTO purchase_order (po_id, sup_id, admin_id, mat_id, number) ";
    $sql .= " VALUES($poid, $sup_id[$i], $adminID, $mat_id[$i], $number[$i])";
    mysqli_query($conn, $sql) or die('Die query');
  }
  header("Location: /suthep/purchase_order_invoice.php?poid=$poid");
  die();
} else {
  echo "Nope";
}

 ?>
