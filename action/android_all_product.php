<?php
  require_once '../database/connector.php';
  $sql = "SELECT * FROM product";
  $query = mysqli_query($conn, $sql);
  $data = array();
  while ($row = mysqli_fetch_assoc($query)) {
    array_push($data, $row);
  }
  echo json_encode($data);
 ?>
