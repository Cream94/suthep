<?php
  require_once '../database/connector.php';
  $id = isset($_GET["id"]) ? $_GET["id"] : null; // short if.

  $sql = "SELECT * FROM product where owner = $id";
  $query = mysqli_query($conn, $sql);
  $data = array();
  while ($row = mysqli_fetch_assoc($query)) {
    array_push($data, $row);
  }
  echo json_encode($data);
 ?>
