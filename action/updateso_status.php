<?php
require_once '../database/connector.php';
$so_id = isset($_GET["so_id"]) ? $_GET["so_id"] : null; // short if.
$status = isset($_POST["status_id"]) ? $_POST["status_id"] : null; // short if.

if ($status != null) {
  $sql = "UPDATE sale_order SET status =  $status WHERE so_id = $so_id ";
  $query = mysqli_query($conn, $sql) or die('Die query => ' . mysqli_error($conn));
}
 ?>
