<?php
  require_once '../database/connector.php';
  $custID = $_GET["cust_id"];

  $sql = "SELECT *, count(so.so_id) as count, sum((so.number * prod.weight) * prod.price) as total FROM sale_order so, product prod WHERE
               cust_id = $custID and so.prod_id = prod.prod_id group by so_id ORDER BY date_time DESC ";

  $query = mysqli_query($conn, $sql);
  $data = array();
  while ($row = mysqli_fetch_assoc($query)) {
    array_push($data, $row);
  }
  echo json_encode($data);
 ?>
