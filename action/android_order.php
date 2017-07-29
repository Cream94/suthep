<?php
  require_once '../database/connector.php';
  $custID = $_GET["cust_id"];

  // $sql = "SELECT *, count(so.so_id) as count, sum((so.number * prod.weight) * prod.price) as total
  //         FROM sale_order so, product prod, so_status sos
  //         WHERE (sos.status_id <> 5 and sos.status_id <> 6 and sos.status_id <> 7) and cust_id = $custID
  //         and so.prod_id = prod.prod_id group by so_id";

$sql = "SELECT *, sum(so.number) as total FROM sale_order as so
  left join customer as c on c.cust_id = so.cust_id
  left join so_status as sos on so.status = sos.status_id WHERE (sos.status_id <> 6 and sos.status_id <> 7)
  and so.cust_id = $custID group by so.so_id ORDER BY date_time DESC ";


  $query = mysqli_query($conn, $sql);
  $data = array();
  while ($row = mysqli_fetch_assoc($query)) {
    array_push($data, $row);
  }
  echo json_encode($data);
 ?>
