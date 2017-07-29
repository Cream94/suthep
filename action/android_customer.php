<?php
  require_once '../database/connector.php';
  $custID = $_GET["cust_id"];

  $sql = "SELECT * FROM customer WHERE customer.cust_id = $custID";

  $query = mysqli_query($conn, $sql);
  $data = array();
  while ($row = mysqli_fetch_assoc($query)) {
    array_push($data, $row);
  }
  echo json_encode($data);
 ?>
