<?php
require_once '../database/connector.php';
$po_id = isset($_GET["po_id"]) ? $_GET["po_id"] : null; // short if.
$status = isset($_POST["status_id"]) ? $_POST["status_id"] : null; // short if.

if ($status != null) {
  $sql = "UPDATE purchase_order SET status =  $status WHERE po_id = $po_id ";
  $query = mysqli_query($conn, $sql) or die('Die query => ' . mysqli_error($conn));

  if ($status == 2 || $status == 4){
    $sql2 = "SELECT * FROM purchase_order WHERE po_id = $po_id and receive = 0";
    $query2 = mysqli_query($conn, $sql2) or die('Die query => ' . mysqli_error($conn));

    $sql = "UPDATE purchase_order SET receive = 1 WHERE po_id = $po_id ";
    $query = mysqli_query($conn, $sql) or die('Die query => ' . mysqli_error($conn));

    while ($row = mysqli_fetch_array($query2)) {
      $update = "UPDATE stock SET number = number + ".$row['number']." WHERE mat_id = ". $row["mat_id"];
      $queryStock = mysqli_query($conn, $update);
    }
  }



}
 ?>
