<?php
require_once '../database/connector.php';
$cust_id = isset($_GET["cust_id"]) ? $_GET["cust_id"] : null; // short if.
$deposit = isset($_POST["deposit"]) ? $_POST["deposit"] : null; // short if.

if ($deposit != null) {
  $sql = "UPDATE sale_order SET deposit =  $deposit WHERE cust_id = $cust_id ";
  $query = mysqli_query($conn, $sql) or die('Die query => ' . mysqli_error($conn));
}
 ?>
