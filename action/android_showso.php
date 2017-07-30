<?php
  require_once '../database/connector.php';
  $soID = $_GET["so_id"];

  $sql = "SELECT *, sum(so.number) as total FROM sale_order as so left join customer as c on c.cust_id = so.cust_id
          left join admin as ad on ad.admin_id = so.admin_id
          left join product as p on p.prod_id = so.prod_id
          left join so_status as sos on sos.status_id = so.status
          WHERE so.so_id = $soID group by so.prod_id";

  $query = mysqli_query($conn, $sql);
  $data = array();
  while ($row = mysqli_fetch_assoc($query)) {
    array_push($data, $row);
  }
  echo json_encode($data);
 ?>
