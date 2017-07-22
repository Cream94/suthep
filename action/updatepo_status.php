<?php
require_once '../database/connector.php';
$po_id = isset($_GET["po_id"]) ? $_GET["po_id"] : null; // short if.
$status = isset($_POST["status_id"]) ? $_POST["status_id"] : null; // short if.

if ($status != null) {
  $sql = "UPDATE purchase_order SET status =  $status WHERE po_id = $po_id ";
  $query = mysqli_query($conn, $sql) or die('Die query => ' . mysqli_error($conn));
}
 ?>
